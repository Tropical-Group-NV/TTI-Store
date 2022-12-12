<?php

namespace App\Http\Livewire;

use App\Models\SalesOrder;
use App\Models\ViewQBCustomer;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;


class Customer extends Component
{
    use WithPagination;

    public $customer;
//    public $orders;
    public $search;
    public $showOrder = 0;
    public $viewCustomer;

    public function mount(Request $request)
    {
        $this->viewCustomer = ViewQBCustomer::query()->where('ListID', $request->customer)->first(['last_visit', 'flag']);
        $this->customer = $request->customer;
        if(!isset($request->orderSearch))
        {
            $this->search = '';
        }
        else
        {
            $this->search = $request->orderSearch;
        }
//        $this->orders = SalesOrder::where('CustomerRefListID', $request->customer->ListID)->get();
    }

    public function render(Request $request)
    {

        return view('livewire.customer', ['orders' => SalesOrder::where('CustomerRefListID', $this->customer->ListID)->orderBy('id', 'DESC')->paginate(10)]);
    }

    public function showOrders()
    {
        $this->showOrder =1;
    }
    public function hideOrders()
    {
        $this->showOrder =0;
    }
}
