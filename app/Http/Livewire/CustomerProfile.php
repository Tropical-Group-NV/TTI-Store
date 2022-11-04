<?php

namespace App\Http\Livewire;

use App\Models\QbCustomer;
use App\Models\UserCustomer;
use Illuminate\Http\Request;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CustomerProfile extends Component
{
    public $countries;
    public $customer;
    public $customerFirstName;
    public $customerLastName;
    public $customerCountry;
    public $customerAddress;
    private $userCustomer;
    public $user;


    public function mount()
    {
        $this->userCustomer = UserCustomer::query()->where('user_id', Auth::user()->id)->first();
        $this->customer = QbCustomer::where('ListID', $this->userCustomer->customer_ListID)->first();
        $this->customerFirstName = $this->customer->FirstName;
        $this->customerLastName = $this->customer->LastName;
        $this->customerAddress = $this->customer->BillAddressBlockAddr2;
        $this->customerCountry = $this->customer->BillAddressBlockAddr4;
        $this->countries = json_decode(\Illuminate\Support\Facades\Http::get('https://countriesnow.space/api/v0.1/countries'), true);
//        $this->userCustomer = json_decode(json_encode(DB::connection('qb_sales')->table('users_customer')->where('user_id', Auth::user()->id)->first(), true), true) ;

    }
    public function render()
    {
        return view('livewire.customer-profile');
    }

    public function saveInfo()
    {
        QbCustomer::query()->where('ListID', $this->userCustomer->customer_ListID)->update(
            [
                'FirstName' => $this->customerFirstName,
                'LastName' => $this->customerLastName,
                'FullName' => $this->customerFirstName . ' ' . $this->customerLastName,
                'Name' => $this->customerFirstName . ' ' . $this->customerLastName,
                'BillAddressAddr1' => $this->customerFirstName . ' ' . $this->customerLastName,
                'BillAddressAddr2' => $this->customerAddress,
                'BillAddressAddr4' => $this->customerCountry,
                'BillAddressBlockAddr1' => $this->customerFirstName . ' ' . $this->customerLastName,
                'BillAddressBlockAddr2' => $this->customerAddress,
                'BillAddressBlockAddr4' => $this->customerCountry,
                'ShipAddressAddr1' => $this->customerFirstName . ' ' . $this->customerLastName,
                'ShipAddressAddr2' => $this->customerAddress,
                'ShipAddressAddr4' => $this->customerCountry,
                'ShipAddressBlockAddr1' => $this->customerFirstName . ' ' . $this->customerLastName,
                'ShipAddressBlockAddr2' => $this->customerAddress,
                'ShipAddressBlockAddr4' => $this->customerCountry,
            ]
        );
    }
}
