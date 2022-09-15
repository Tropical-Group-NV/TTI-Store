<?php

namespace App\Http\Controllers;

use App\Jobs\CustomerRegistrationMailJob;
use App\Mail\OrderNew;
use App\Mail\registrationCustomer;
use App\Models\TemporaryUserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CustomerRegistration extends Controller
{
    public function index()
    {
        return view('customer-register');
    }
    public function create()
    {
    }
    public function update()
    {
    }
    public function store(Request $request)
    {
        if (!TemporaryUserInfo::query()->where('email', $request->email)->exists())
        {
            $creds = new TemporaryUserInfo();
            $creds->name = $request->name;
            $creds->firstname = $request->firstname;
            $creds->company_name = $request->company_name;
            $creds->company_type = $request->company_type;
            $creds->address = $request->address;
            $creds->phone = $request->phone;
            $creds->email = $request->email;
            $creds->save();
            CustomerRegistrationMailJob::dispatch($creds->id);
            session()->flash('success', 'Uw registratie is succesvol. U zal binnenkort een mail ontvangen.');
            return back();
        }
        else
        {
            session()->flash('error', 'User with same email already exists');
            return back();
        }
//        return $creds->id;/
//        die($request->email);

    }

    public function delete()
    {
    }

    public function show()
    {
    }
}
