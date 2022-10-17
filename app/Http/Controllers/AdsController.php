<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdsController extends Controller
{
    public function index()
    {
        if (\Auth::user()->users_type_id == 1)
        {
            return view('ads');
        }
        else
        {
            return 'no access';
        }
    }

    public function __construct()
    {
        $this->middleware('auth');
    }
}
