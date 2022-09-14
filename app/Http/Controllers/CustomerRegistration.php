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
        $creds = new TemporaryUserInfo();
        $creds->name = $request->name;
        $creds->firstname = $request->firstname;
        $creds->company_name = $request->company_name;
        $creds->company_type = $request->company_type;
        $creds->address = $request->adress;
        $creds->phone = $request->phone;
        $creds->email = $request->email;
        $creds->save();


//        return $creds->id;/
//        die($request->email);
        CustomerRegistrationMailJob::dispatch($creds->id);
        return redirect( route('home'));
    }

    public function delete()
    {
    }

    public function show()
    {
    }
}
