<?php

namespace App\Http\Livewire;

use App\Models\Customer;
use App\Models\CustomerVisitFrequency;
use Livewire\Component;
use Livewire\WithPagination;

class Customers extends Component
{
    public $search;
//    private $customers;
    use WithPagination;

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
        return view('livewire.customers', ['customers' => \DB::connection('epas')->table('QB_Customer')->where('Name', 'LIKE', '%'. $this->search . '%')->where('IsActive', 1)->orWhere('FirstName', 'LIKE', '%'. $this->search . '%')->where('IsActive', 1)->orWhere('LastName', 'LIKE', '%'. $this->search . '%')->where('IsActive', 1)->orWhere('Email', 'LIKE', '%'. $this->search . '%')->where('IsActive', 1)->paginate(20, ['FullName', 'ListID', 'CustomFieldKlanttype', 'Name', 'CompanyName', 'FirstName', 'LastName', 'Email', 'TotalBalance', 'IsActive'])]);
    }

    public function changeVisitFreq($customer_id, $freq)
    {
        $update = CustomerVisitFrequency::query()->where('customer_id', $customer_id)->update(['days' => $freq]);
    }
}
