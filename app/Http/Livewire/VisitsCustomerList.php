<?php

namespace App\Http\Livewire;

use App\Models\CustomerVisitFreq;
use App\Models\CustomerVisitFrequency;
use App\Models\SalesRepUser;
use App\Models\ViewQBCustomer;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class VisitsCustomerList extends Component
{
    use WithPagination;

    public $search;
    public function mount()
    {
        if (isset($_REQUEST['search']))
        {
            $this->search = $_REQUEST['search'];
        }
        if (isset($_REQUEST['customerSearch']))
        {
            $this->search = $_REQUEST['customerSearch'];
        }
    }

    public function render()
    {
        if (Auth::user()->users_type_id == 2)
        {
            $salesRep = SalesRepUser::query()->where('user_id', Auth::user()->id)->first();

            if ($this->search != null)
            {
                $customers = ViewQBCustomer::query()->where('FullName', 'LIKE', '%' . $this->search . '%')->where('SalesRepRefListID', $salesRep->salesRep_ListID)->whereNot('location', null)->orWhere('BillAddressBlockAddr2', 'LIKE', '%' . $this->search . '%')->where('SalesRepRefListID', $salesRep->salesRep_ListID)->whereNot('location', null)->orderBy('last_visit', 'DESC')->paginate(10);
            }
            else
            {
                $customers = ViewQBCustomer::query()->whereNot('location', null)->where('SalesRepRefListID', $salesRep->salesRep_ListID)->orderBy('last_visit', 'DESC')->paginate(10);
            }
//            return view('visits.visits', compact('customers'));
            return view('livewire.visits-customer-list', ['customers' => ViewQBCustomer::query()->whereNot('location', null)->where('SalesRepRefListID', $salesRep->salesRep_ListID)->orderBy('last_visit', "DESC")->orderBy('last_visit', 'DESC')->paginate(10)]);
        }
        else
        {
            if ($this->search != null)
            {
                $customers = ViewQBCustomer::query()->where('FullName', 'LIKE', '%' . $this->search . '%')->whereNot('location', null)->orWhere('BillAddressBlockAddr2', 'LIKE', '%' . $this->search . '%')->whereNot('location', null)->orderBy('last_visit', 'DESC')->paginate();
            }
            else
            {
                $customers = ViewQBCustomer::query()->whereNot('location', null)->orderBy('last_visit', 'DESC')->paginate(10);

            }
            return view('livewire.visits-customer-list', ['customers' => $customers]);

        }
    }
}
