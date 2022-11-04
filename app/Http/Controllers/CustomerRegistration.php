<?php

namespace App\Http\Controllers;

use App\Jobs\CreateQBCustomer;
use App\Jobs\CustomerRegistrationMailJob;
use App\Mail\OrderNew;
use App\Mail\registrationCustomer;
use App\Models\LoginToken;
use App\Models\TemporaryUserInfo;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class CustomerRegistration extends Controller
{
    public function index()
    {
        if (Auth::user() == null)
        {
            $countries = json_decode(\Illuminate\Support\Facades\Http::get('https://countriesnow.space/api/v0.1/countries'), true);
//            $uInfo = TemporaryUserInfo::query()->where('id', 46)->first();
//
//            $Customer = DB::connection('qb_sales')->update( "EXEC [dbo].[sp_create_new_customer] @name = '" . $uInfo->firstname . " " . $uInfo->name. "' ,@Firstname = '" . $uInfo->firstname . "',@Lastname = '" . $uInfo->name . "',@CompanyName = '" . $uInfo->company_name . "' ,@BillAddressBlockAddr1 = '" . $uInfo->firstname . " " . $uInfo->name . "' ,@BillAddressBlockAddr2 = '" . $uInfo->address . "' ,@Phone = '" . $uInfo->phone . "',@Email = '" . $uInfo->email . "'" );
//            print_r($Customer);

//            $uInfo = TemporaryUserInfo::query()->where('id', 45)->first();
//
//            DB::connection('qb_sales')->update( "EXEC sp_create_new_customer @name = '" . $uInfo->firstname . " " . $uInfo->name. "' ,@Firstname = '" . $uInfo->firstname . "',@Lastname = '" . $uInfo->name . "',@CompanyName = '" . $uInfo->company_name . "' ,@BillAddressBlockAddr1 = '" . $uInfo->firstname . " " . $uInfo->name . "' ,@BillAddressBlockAddr2 = '" . $uInfo->address . "' ,@Phone = '" . $uInfo->phone . "',@Email = '" . $uInfo->email . "';SET NOCOUNT ON;" );
//            CreateQBCustomer::dispatch(50);
            return view('customer-register', compact('countries'));
        }
        else
        {
            return redirect(route('home'));
        }

    }
    public function create()
    {

    }
    public function update()
    {

    }
    public function store(Request $request)
    {
        if($request->surname == '')
        {
            if (!TemporaryUserInfo::query()->where('email', $request->email)->exists() or !User::where('username', $request->username)->exists())
            {
                $user = new User();
                $user->username = $request->username;
                $user->password = password_hash($request->password, PASSWORD_DEFAULT) ;
                $user->name = $request->firstname;
                $user->last_name = $request->name;
                $user->users_type_id = 3;
                $user->active = 0;
                $user->save();

                $creds = new TemporaryUserInfo();
                $creds->name = $request->name;
                $creds->firstname = $request->firstname;
                if ($request->company_check == 1)
                {
                    $creds->company_name = $request->company_name;
                    $creds->company_type = $request->company_type;
                }
                $creds->address = $request->address;
                $creds->phone = $request->phone;
                $creds->email = $request->email;
                $creds->country = $request->country;
                $creds->uid = $user->id;
                $creds->save();

                $token = new LoginToken();
                $token->uid  = $user->id;
                $token->active = 1;
                $token->token = hash('md5', date('Y-m-d h:i:s') . $user->id);
                $token->save();
//            Auth::guard('eloquent');
//            $validated = Auth::guard('eloquent')->attempt(['username' => $request->username, 'password' => $request->password]);
//            if ($validated)
//            {
//                Auth::loginUsingId($user->id);
//            }
//            return redirect(route('home'));
            CustomerRegistrationMailJob::dispatch($creds->id);
                if ($request->company_check == 1)
                {
                    CreateQBCustomer::dispatch($creds->id, 1);
                }
                else
                {
                    CreateQBCustomer::dispatch($creds->id, 0);
                }


                session()->flash('success', 'Uw registratie is succesvol. U zal binnenkort een email ontvangen om uw account te verifiëren.');
                return back();
            }
            else
            {
                if (TemporaryUserInfo::query()->where('email', $request->email)->exists())
                {
                    session()->flash('error', 'User with same email already exists');
                }
                if (User::where('id', $request->username)->exists())
                {
                    session()->flash('error', 'User with same username already exists');
                }

                return back();
            }
        }
        else
        {

            return redirect('https://media.tenor.com/_4YgA77ExHEAAAAd/rick-roll.gif');
        }

    }

    public function delete()
    {
    }

    public function show()
    {
    }
}
