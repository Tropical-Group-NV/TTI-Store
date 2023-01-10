<?php

namespace App\Http\Livewire;

use App\Mail\CrmMail;
use App\Mail\OrderNew;
use App\Models\CrmInteraction;
use App\Models\CrmInteractionStatus;
use App\Models\QbCustomer;
use App\Models\SalesRep;
use App\Models\User;
use App\Models\ViewQBCustomer;
use Barryvdh\DomPDF\PDF;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\File;

class ViewCrm extends Component
{
    use WithPagination;

    public $search = '';
    public $dateTime;
    public $customerID;
    public $customers = [];
    public $subject;
    public $description;
    public $reminder;
    public $statusID;
    public $customerSearch;
    public $statuses;
    public $sendMail;

    protected $rules =
        [
            'subject' => 'required',
            'description' => 'required',
            'statusID' => 'required',
            'customerID' => 'required'
        ];


    public function mount()
    {
        if (isset($_REQUEST['search'])) {
            $this->search = $_REQUEST['search'];
        }
        $this->dateTime = date('Y-m-d H:i');

        $this->statuses = CrmInteractionStatus::query()->orderBy('name', 'ASC')->get();

    }

    public function render()
    {
        if ($this->search != null) {
            $customers = QbCustomer::query()->where('Name', 'LIKE', '%' . $this->search . '%')->orderBy('Name', 'ASC')->limit(10)->pluck('ListID')->toArray();
            $users = User::query()->where('name', 'LIKE', '%' . $this->search . '%')->orWhere('last_name', 'LIKE', '%' . $this->search . '%')->orderBy('Name', 'ASC')->limit(10)->pluck('id')->toArray();
            $tickets = CrmInteraction::query()->orderBy('id', 'DESC')->whereIn('customer_ListID', $customers)->orWhereIn('rep_user_id', $users)->orWhere('subject', 'LIKE', '%' . $this->search . '%')->orWhere('description', 'LIKE', '%' . $this->search . '%')->paginate(20);
        }
        else
        {
            $tickets = CrmInteraction::query()->orderBy('id', 'DESC')->paginate(20);
        }
        return view('livewire.view-crm', ['crms' => $tickets]);
    }

    public function createTicket()
    {
        $this->validate();
        $ticket = new CrmInteraction();
        $ticket->date_time = str_replace('T', ' ' ,  $this->dateTime);
        $ticket->rep_user_id = Auth::user()->id;
        $ticket->subject = $this->subject;
        $ticket->description = $this->description;
        if ($this->reminder != null)
        {
            $ticket->reminder = str_replace('T', ' ' ,  $this->reminder);
        }
        $ticket->status_id = $this->statusID;
        $ticket->customer_ListID = $this->customerID;
        $ticket->save();
        $this->subject = '';
        $this->description = '';
        $this->reminder = '';
        $this->dateTime = date('Y-m-d H:i');
        $this->statusID = '';
        $this->customerID = '';
        $this->customerSearch = '';
        $this->dispatchBrowserEvent('createdTicket');
        if ($this->sendMail == 1)
        {

            $crm = CrmInteraction::query()->where('id', $ticket->id)->first();

            $customer = QbCustomer::query()->where('ListID', $crm->customer_ListID)->first();

            Mail::to($customer->Email)->send(new CrmMail($ticket->subject, $ticket->description));
        }


    }

    public function searchCustomers()
    {
        $this->customers = ViewQBCustomer::query()->where('Fullname', 'like', '%' . $this->customerSearch . '%')->where('IsActive', 1)->limit(5)->get(['FullName', 'BillAddressBlockAddr1', 'BillAddressBlockAddr2', 'BillAddressBlockAddr3', 'BillAddressBlockAddr4', 'BillAddressBlockAddr5', 'ListID']);
    }

    public function setCustomerID($customerID)
    {
        $cust = \App\Models\Customer::query()->where('ListID', $customerID)->first();
        $this->customerID = $customerID;
        $this->customerSearch = $cust->FullName;
    }

    public function updateCrm($crmID, $dt, $subject, $desc, $reminder, $status, $mail)
    {
        if ($reminder != null)
        {
            CrmInteraction::query()->where('id', $crmID)->update(['date_time' => str_replace('T', ' ', $dt ?? null) , 'subject' => $subject, 'description' => $desc, 'reminder' => str_replace('T', ' ', $reminder ?? null) ?? null, 'status_id' => $status]);
        }
        else
        {
            CrmInteraction::query()->where('id', $crmID)->update(['date_time' => str_replace('T', ' ', $dt ?? null) , 'subject' => $subject, 'description' => $desc, 'status_id' => $status]);

        }
        if ($mail == true)
        {

             $crm = CrmInteraction::query()->where('id', $crmID)->first();

            $customer = QbCustomer::query()->where('ListID', $crm->customer_ListID)->first();

            Mail::to($customer->Email)->send(new CrmMail($subject, $desc));
        }
        $this->dispatchBrowserEvent('savedTicket');

    }

    public function exportJson()
    {
        $num = 0;
        $crmArray = [];
        $crms = CrmInteraction::query()->orderBy('id', 'DESC')->paginate(20);
        foreach ($crms as $crm)
        {
            $num++;
            $customer = \App\Models\Customer::query()->where('ListID', $crm->customer_ListID)->first('FullName');
            $rep = \App\Models\User::query()->where('id', $crm->rep_user_id)->first();
            $status = \App\Models\CrmInteractionStatus::query()->where('id', $crm->status_id)->first();
            $crmArray[$num]['Date'] = $crm->date_time;
            $crmArray[$num]['Salesrep'] = $rep->name ?? '';
            $crmArray[$num]['Customer'] = $customer->FullName ?? '';
            $crmArray[$num]['Subject'] = $crm->subject;
            $crmArray[$num]['Description'] = $crm->description;
            $crmArray[$num]['Reminder'] = $crm->reminder;
            $crmArray[$num]['Status'] = $status->name ?? '';
        }
        $file = 'CRM-' . time() . '.json';
        $crmJson = json_encode($crmArray, true);
        Storage::put('/json/' . $file, $crmJson);
//        File::put('json/' . $file, $crmJson);
        return Storage::download('json/' . $file);
    }
    public function exportPDF()
    {
        $num = 0;
        $crmArray = [];
        $crms = CrmInteraction::query()->orderBy('id', 'DESC')->paginate(20);

        $data = ['crms2' => $crms];
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.crm', $data);
        $pdf->setPaper('a4', 'landscape');
        $savePdf =  $pdf->download('CRM-' . time() . '.pdf')->getOriginalContent();
        $filename = '/pdf/CRM-' . time();
        Storage::put($filename, $savePdf);
        return Storage::download($filename);
    }
    public function exportTxt()
    {
        $num = 0;
        $crmArray = [];
        $crms = CrmInteraction::query()->orderBy('id', 'DESC')->paginate(20);
        foreach ($crms as $crm)
        {
            $num++;
            $customer = \App\Models\Customer::query()->where('ListID', $crm->customer_ListID)->first('FullName');
            $rep = \App\Models\User::query()->where('id', $crm->rep_user_id)->first();
            $status = \App\Models\CrmInteractionStatus::query()->where('id', $crm->status_id)->first();
            $crmArray[$num]['Date'] = $crm->date_time;
            $crmArray[$num]['Salesrep'] = $rep->name ?? '';
            $crmArray[$num]['Customer'] = $customer->FullName ?? '';
            $crmArray[$num]['Subject'] = $crm->subject;
            $crmArray[$num]['Description'] = $crm->description;
            $crmArray[$num]['Reminder'] = $crm->reminder;
            $crmArray[$num]['Status'] = $status->name ?? '';
        }
        $file = 'CRM-' . time() . '.txt';
        $crmJson = json_encode($crmArray, true);
        Storage::put('/txt/' . $file, $crmJson);
//        File::put('json/' . $file, $crmJson);
        return Storage::download('txt/' . $file);
    }
    public function exportCsv()
    {
        $num = 0;
        $crmCsv = '"Date", "Salesrep", "Customer", "Subject", "Description", "Reminder", "Status",';
        $crms = CrmInteraction::query()->orderBy('id', 'DESC')->paginate(20);
        foreach ($crms as $crm)
        {
            $num++;
            $customer = \App\Models\Customer::query()->where('ListID', $crm->customer_ListID)->first('FullName');
            $rep = \App\Models\User::query()->where('id', $crm->rep_user_id)->first();
            $status = \App\Models\CrmInteractionStatus::query()->where('id', $crm->status_id)->first();
            $crmCsv = $crmCsv . '"' . $crm->date_time. '",';
            $crmArray[$num]['Salesrep'] = $rep->name ?? '';
            $crmArray[$num]['Customer'] = $customer->FullName ?? '';
            $crmArray[$num]['Subject'] = $crm->subject;
            $crmArray[$num]['Description'] = $crm->description;
            $crmArray[$num]['Reminder'] = $crm->reminder;
            $crmArray[$num]['Status'] = $status->name ?? '';
        }
        $file = 'CRM-' . time() . '.txt';
        $crmJson = json_encode($crmArray, true);
        Storage::put('/txt/' . $file, $crmJson);
//        File::put('json/' . $file, $crmJson);
        return Storage::download('txt/' . $file);
    }
}
