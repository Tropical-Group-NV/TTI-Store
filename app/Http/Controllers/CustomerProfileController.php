<?php

namespace App\Http\Controllers;

use App\Jobs\UpdateQBCustomerInfo;
use App\Ldap\User;
use App\Models\QbCustomer;
use App\Models\UserCustomer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerProfileController extends Controller
{
    public function index()
    {
        $userCustomer = UserCustomer::query()->where('user_id', Auth::user()->id)->first();
        $customer = QbCustomer::where('ListID', $userCustomer->customer_ListID)->first();
        $countries = json_decode(\Illuminate\Support\Facades\Http::get('https://countriesnow.space/api/v0.1/countries'), true);

        return view('profile.profile', compact('customer', 'userCustomer', 'countries'));
    }

    public function store(Request $request)
    {
//        die($request->listid);
        QbCustomer::query()->where('ListID', $request->listid)->update(
            [
                'FirstName' => $request->firstname,
                'LastName' => $request->lastname,
                'FullName' => $request->firstname . ' ' . $request->lastname,
                'Name' => $request->firstname . ' ' . $request->lastname,
                'BillAddressAddr1' => $request->firstname . ' ' . $request->lastname,
                'BillAddressAddr2' => $request->address,
                'BillAddressAddr4' => $request->country,
                'BillAddressBlockAddr1' => $request->firstname . ' ' . $request->lastname,
                'BillAddressBlockAddr2' => $request->address,
                'BillAddressBlockAddr4' => $request->country,
                'ShipAddressAddr1' => $request->firstname . ' ' . $request->lastname,
                'ShipAddressAddr2' => $request->address,
                'ShipAddressAddr4' => $request->country,
                'ShipAddressBlockAddr1' => $request->firstname . ' ' . $request->lastname,
                'ShipAddressBlockAddr2' => $request->address,
                'ShipAddressBlockAddr4' => $request->country,
                'Phone' => $request->phone,
                'CompanyName' => $request->companyname
            ]


        );

        \App\Models\User::query()->where('id', Auth::user()->id)->update(['name' => $request->firstname, 'last_name' => $request->lastname]);
        UpdateQBCustomerInfo::dispatch($request->listid);
        return back();
    }


    public function __construct()
    {
        $this->middleware('auth');
    }
}
