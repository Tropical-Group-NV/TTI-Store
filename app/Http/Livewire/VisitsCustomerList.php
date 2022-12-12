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
        if ($this->search == '')
        {
            $this->search = '';
        }
        if (isset($_REQUEST['customerSearch']))
        {
            $this->search = $_REQUEST['customerSearch'];
        }
    }

    public function render()
    {
        if (Auth::user()->users_ype_id == 2)
        {
            $salesRep = SalesRepUser::query()->where('user_id', Auth::user()->id)->first();
            $customers = ViewQBCustomer::query()->whereNot('location', null)->where('SalesRepRefListID', $salesRep->salesRep_ListID)->get(['ListID','FullName', 'location', 'visits_frequency', 'last_visit', 'last_order', 'flag']);
//            return view('visits.visits', compact('customers'));
            return view('livewire.visits-customer-list', ['customers' => ViewQBCustomer::query()->whereNot('location', null)->where('SalesRepRefListID', $salesRep->salesRep_ListID)->orderBy('last_visit', "DESC")->paginate(10)]);
        }
        else
        {
            $customers = ViewQBCustomer::query()->whereNot('location', null)->get(['ListID','FullName', 'location', 'visits_frequency', 'last_visit', 'last_order', 'flag']);
            return view('livewire.visits-customer-list', ['customers' => ViewQBCustomer::query()->whereNot('location', null)->orderBy('last_visit', "DESC")->paginate(10)]);

        }
    }
}
