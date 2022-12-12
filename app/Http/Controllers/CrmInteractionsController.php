<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CrmInteractionsController extends Controller
{
    public function index()
    {
        return view('crm.view-crm');
    }
}
