<?php

namespace App\Http\Livewire;

use App\Jobs\Import_Sales_Order_To_QB;
use App\Mail\QuotationMail;
use App\Models\CrmInteraction;
use App\Models\QbCustomer;
use App\Models\Quotation;
use App\Models\QuotationItem;
use App\Models\SalesOrder;
use App\Models\SalesOrderItem;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class ViewQuotations extends Component
{
    use WithPagination;
    public $search;

    public function mount()
    {
        if (isset($_REQUEST['search']))
        {
            $this->search = $_REQUEST['search'];
        }
    }

    public function render()
    {
        if ($this->search != null)
        {
            $users = User::query()->where('name', 'LIKE', '%' . $this->search . '%')->orWhere('last_name', 'LIKE', '%' . $this->search . '%')->orderBy('name', 'ASC')->pluck('id')->toArray();
            $quotations = Quotation::query()->orderBy('id', 'DESC')->where('RefNumber', 'LIKE', '%' . $this->search . '%')->orWhere('BillAddressAddr1', 'LIKE', '%' . $this->search . '%')->orWhere('BillAddressAddr2', 'LIKE', '%' . $this->search . '%')->orWhere('PONumber', 'LIKE', '%' . $this->search . '%')->orWhere('TermsRefFullName', 'LIKE', '%' . $this->search . '%')->orWhereIn('uid', $users)->paginate(20);
        }
        else
        {
            $quotations = Quotation::query()->orderBy('id', 'DESC')->paginate(20);
        }
        return view('livewire.view-quotations', ['quotations'=> $quotations]);
    }

    public function delete($qID)
    {
        Quotation::query()->where('id', $qID)->delete();
        $this->dispatchBrowserEvent('deletedQuotation', ['qID' => $qID] );
    }

    public function exportPDF($id)
    {
        $quotation = Quotation::query()->where('id', $id)->first();
        $data = ['model' => $quotation, 'quotation' => $quotation];
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.quotation', $data);
        $pdf->setPaper('a4', 'portrait');
        $savePdf =  $pdf->download('Q-' . time() . '.pdf')->getOriginalContent();
        $filename = '/quotation/Q-' . time();
        Storage::put($filename, $savePdf);
        return Storage::download($filename);
    }

    public function sendMail($from, $to, $cc, $subject, $description, $qId)
    {
        $quotation = Quotation::query()->where('id', $qId)->first();
        $mail = Mail::to($to)->cc($cc)->send(new QuotationMail($from, $to, $cc, $subject, $description, $qId));
        if ($mail)
        {
            $crm = new CrmInteraction();
            $crm->date_time = date('Y-m-d H:i:s');
            $crm->rep_user_id = Auth::user()->id;
            $crm->subject = $subject;
            $crm->description = $description;
            $crm->status_id = 2;
            $crm->customer_ListID = $quotation->CustomerRefListID;
            $crm->save();

            $qMail = new \App\Models\QuotationMail();
            $qMail->quotation_id = $qId;
            $qMail->crm_interactions_id = $crm->id;
            $qMail->datetime_sent = date('Y-m-d H:i:s');
            $qMail->from_email = $from;
            $qMail->to_email = $to;
            $qMail->cc_email = $cc;
            $qMail->save();

            $this->dispatchBrowserEvent('sentMail');
        }
        else
        {
            $this->dispatchBrowserEvent('failedMail');
        }
    }

    public function createSo($qId)
    {
        $quotation = Quotation::query()->where('id', $qId)->first();
        $creationStatus = 1;
        $qItems = QuotationItem::query()->where('quotation_id', $qId)->get();
        foreach ($qItems as $qItem)
        {
            if ($qItem->SalesOrderLineItemRefListID != '520000-1128115782')
            {
                $item = \App\Models\Item::query()->where('ListID', $qItem->SalesOrderLineItemRefListID)->first(['ListID', 'QuantityOnHand', 'QuantityOnSalesOrder']);
                $itemStock = $item->QuantityOnHand - $item->QuantityOnSalesOrder;
                if (($itemStock - $qItem->SalesOrderLineQuantity) < 1)
                {
                    $creationStatus = 0;
                }
            }
        }
        if ($creationStatus == 1)
        {
//            $customer = QbCustomer::query()->where('ListID', $)
            $sale = new SalesOrder();
            $sale->CustomerRefListID = $quotation->CustomerRefListID;
            $sale->TxnDate = $quotation->TxnDate;
            $sale->BillAddressAddr1 = $quotation->BillAddressAddr1;
            $sale->BillAddressAddr2 = $quotation->BillAddressAddr2;
            $sale->BillAddressAddr3 = $quotation->BillAddressAddr3;
            $sale->BillAddressAddr4 = $quotation->BillAddressAddr4;
            $sale->BillAddressAddr5 = $quotation->BillAddressAddr5;
            $sale->ShipAddressAddr1 = $quotation->BillAddressAddr1;
            $sale->ShipAddressAddr2 = $quotation->BillAddressAddr2;
            $sale->ShipAddressAddr3 = $quotation->BillAddressAddr3;
            $sale->ShipAddressAddr4 = $quotation->BillAddressAddr4;
            $sale->ShipAddressAddr5 = $quotation->BillAddressAddr5;
            $sale->CustomerMsgRefListID = $quotation->CustomerMsgRefListID;
            $sale->CustomerMsgRefFullName = $quotation->CustomerMsgRefFullName;
            $sale->uid = Auth::user()->id;
            $sale->TermsRefListID = $quotation->TermsRefListID;
            $sale->TermsRefFullName = $quotation->TermsRefFullName;
            $sale->ShipDate = $quotation->ShipDate;
            $sale->Memo = $quotation->Memo;
            $sale->save();
            foreach ($qItems as $qItem)
            {
                $item = \App\Models\Item::query()->where('ListID', $qItem->SalesOrderLineItemRefListID)->first(['ListID', 'QuantityOnHand', 'QuantityOnSalesOrder']);
                $saleItem = new SalesOrderItem();
                $saleItem->sales_order_id = $sale->id;
                $saleItem->SalesOrderLineItemRefListID = $item->ListID;
                $saleItem->SalesOrderLineDesc = $qItem->SalesOrderLineDesc;
                $saleItem->SalesOrderLineQuantity = $qItem->SalesOrderLineQuantity;
                $saleItem->SalesOrderLineRate = $qItem->SalesOrderLineRate;
                $saleItem->SalesOrderLineRatePercent = $qItem->SalesOrderLineRatePercent;
                $saleItem->SalesOrderLineAmount = $qItem->SalesOrderLineAmount;
                $saleItem->save();
                $saveItem = \App\Models\Item::query()->where('ListID', $item->ListID)->first();
                $saveItem->QuantityOnSalesOrder = $saveItem->QuantityOnSalesOrder + $qItem->SalesOrderLineQuantity;
                $saveItem->save();
            }
            if (session()->has('currency'))
            {
//                Import_Sales_Order_To_QB::dispatch($sale->id, session()->get('currency'), session()->get('exchangeRate'));
            }
            else
            {
//                Import_Sales_Order_To_QB::dispatch($sale->id, 'SRD', 1);
            }
            Quotation::query()->where('id', $qId)->update(['so_id' => $sale->id, 'is_so' => 1]);
            $this->dispatchBrowserEvent('createdSo');
        }
        else
        {
            $this->dispatchBrowserEvent('failedSo');
        }

    }
}
