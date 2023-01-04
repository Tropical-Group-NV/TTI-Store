<?php

namespace App\Http\Controllers;

use App\Models\CustomerLocation;
use App\Models\ViewQBCustomer;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\View\View;

class CustomersController extends Controller
{
    public function index()
    {
        return view('customer.customers');
    }

    public function show(Customer $customer)
    {
        $viewQbCustomer = ViewQBCustomer::query()->where('ListID', $customer->ListID)->first(['last_visit', 'last_order', 'visits_frequency']);
        if (CustomerLocation::query()->where('customer_id', $customer->ListID)->exists())
        {
            $customerLocationList = CustomerLocation::query()->where('customer_id', $customer->ListID)->first();
            $customerLocation = $customerLocationList->loc;
        }
        else
        {
            $fetchedCustomerLocation = json_decode(file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?address=' . urlencode($customer->BillAddressBlockAddr1 . $customer->BillAddressBlockAddr2 .  $customer->BillAddressBlockAddr3 . $customer->BillAddressBlockAddr4 . $customer->BillAddressBlockAddr5 ) . '&key=AIzaSyBqAc0YQtjj9qX0CqTz78pRyUk5oy2puus'), true);
            $customerLocation = $fetchedCustomerLocation['results'][0]['geometry']['location']['lat'] . ',' .  $fetchedCustomerLocation['results'][0]['geometry']['location']['lng'];
//            $customerLocation = '5.818419267383127, -55.173200368881226';
        }
//        $customerLocation = CustomerLocation::query()->where('customer_id', $customer->ListID)->first();
        return view('customer.customer', compact('customer', 'customerLocation', 'viewQbCustomer'));
    }
}
