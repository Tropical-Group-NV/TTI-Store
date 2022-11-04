<?php

namespace App\Http\Controllers;

use App\Mail\SendResetToken;
use App\Models\AuditMail;
use App\Models\PasswordResetToken;
use App\Models\QbCustomer;
use App\Models\TemporaryUserInfo;
use App\Models\User;
use App\Models\UserCustomer;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PasswordResetController extends Controller
{
    public function index()
    {
        return view('auth.forgot-password');
    }

    public function store(Request $request)
    {
        $userExist = User::query()->where('username', $request->creds)->exists();
        if ($userExist)
        {
            $user = User::query()->where('username', $request->creds)->first();
            $userCustomerExist = UserCustomer::query()->where('user_id', $user->id)->exists();
            if ($userCustomerExist)
            {
                $userCustomer = UserCustomer::query()->where('user_id', $user->id)->first();
                $userCreds = \DB::connection('epas')->table('QB_Customer')->where('ListID', $userCustomer->customer_ListID)->first();
                $resetToken = new PasswordResetToken();
                $resetToken->email = $userCreds->Email;
                $resetToken->token = hash('md5', date('Y-m-d h:i:s') . $user->id);
                $resetToken->created_at = date('Y-m-d h:i:s');
                $resetToken->uid = $user->id;
                $resetToken->save();
                Mail::to($userCreds->Email)->send(new SendResetToken(route('password-reset.show', $resetToken->token)));
                session()->flash('success', '1');
                return back();
            }
            else
            {
                session()->flash('error', 'Looks like your account is managed by our administrators, please contact the IT Department for further assistance.');
                return back();
            }
        }
        else
        {
            session()->flash('error', 'Your username cannot be found. Please rewrite your username correctly.');
            return back();
        }


    }

    public function show(Request $request)
    {
        return view('auth.reset-password', ['request' => $request]);
    }

    public function update(Request $request)
    {
        if($request->password == $request->password_confirmation)
        {
            $token = PasswordResetToken::query()->where('token', $request->token)->first();
            $user = User::query()->where('id', $token->uid)->first();
            $password = password_hash($request->password, PASSWORD_DEFAULT);
            User::query()->where('id', $token->uid)->update(['password' => $password]);
            session()->flash('welcome', 'Your password has successfully been reset');
            PasswordResetToken::query()->where('token', $request->token)->delete();
            Auth::loginUsingId($user->id);
            return redirect(route('home'));
        }
        else
        {
            session()->flash('error', '1');
            return back();
        }
    }
}
