<?php

namespace App\Http\Controllers;

use App\Models\LoginToken;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginTokenController extends Controller
{
    public function index(Request $request)
    {
        $token = LoginToken::query()->where('token', $request->token)->first();
        $user = User::query()->where('id', $token->uid)->first();
        User::query()->where('id', $token->uid)->update(['active' => 1]);
        Auth::loginUsingId($user->id);
        session()->flash('welcome', 'Welcome to TTISTORE. Your account has been verified');
        return redirect( route('home'));
    }
}
