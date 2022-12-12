<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Quotation;

class QuotationsController extends Controller
{
    public function index()
    {
        return view('quotations.view-quotations');
    }

    public function create()
    {
        return view('quotations.create-quotation');
    }
    public function __construct()
    {
        $this->middleware('auth');
    }
}
