<?php

namespace App\Http\Controllers;

use App\Models\CustomerVisitFrequency;
use App\Models\SalesRepUser;
use App\Models\ViewQBCustomer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VisitsController extends Controller
{
    public function index()
    {
//        $visitFreq = CustomerVisitFrequency::query()->limit(300)->get();
        if (Auth::user()->users_type_id == 2)
        {
            $salesRep = SalesRepUser::query()->where('user_id', Auth::user()->id)->first();
            $customers = ViewQBCustomer::query()->whereNot('location', null)->where('SalesRepRefListID', $salesRep->salesRep_ListID)->orderBy('last_order', "DESC")->get(['ListID','FullName', 'location', 'visits_frequency', 'last_visit', 'last_order', 'flag']);
            return view('visits.visits', compact('customers'));
        }
        else
        {
            $customers = ViewQBCustomer::query()->whereNot('location', null)->orderBy('last_order', "DESC")->limit(800)->get(['ListID','FullName', 'location', 'visits_frequency', 'last_visit', 'last_order', 'flag']);
            return view('visits.visits', compact('customers'));
        }


    }
}
