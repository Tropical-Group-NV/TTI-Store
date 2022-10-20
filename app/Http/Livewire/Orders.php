<?php

namespace App\Http\Livewire;

use App\Models\CartItem;
use App\Models\SalesOrder;
use App\Models\SalesOrderItem;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;


class Orders extends Component
{

//    TODO Controller for orders view
    public $search;
    use WithPagination;
//    public $orders;

    public function mount()
    {
        if (isset($_REQUEST['search']))
        {
            $this->search = $_REQUEST['search'];

        }
//        if (Auth::user() != null)
//        {
//            $this->orders = SalesOrder::query()->where('uid', Auth::user()->id)->orderBy('id', 'DESC');

//        }

    }

    public function render()
    {
        if (Auth::user()->users_type_id == 1 or Auth::user()->users_type_id == 5)
        {
            if (isset($_REQUEST['search']))
            {
                return view('livewire.orders', ['orders' => SalesOrder::query()->where('ShipAddressAddr1','LIKE', '%' . $this->search . '%')->orWhere('TermsRefFullName','LIKE', '%' . $this->search . '%')->orWhere('RefNumber','LIKE', '%' . $this->search . '%')->orderBy('id', 'DESC')->paginate(10)]);
            }
            else
            {
                return view('livewire.orders', ['orders' => SalesOrder::query()->orderBy('id', 'DESC')->paginate(10)]);
//                $orders = SalesOrder::query()->orderBy('id', 'DESC')->paginate(10);

            }
        }
        else
        {
            if (isset($_REQUEST['search']))
            {
                return view('livewire.orders', ['orders' => SalesOrder::query()->where('uid', Auth::user()->id)->where('ShipAddressAddr1','LIKE', '%' . $this->search . '%')->orWhere('uid', Auth::user()->id)->where('TermsRefFullName','LIKE', '%' . $this->search . '%')->orWhere('uid', Auth::user()->id)->where('RefNumber','LIKE', '%' . $this->search . '%')->orderBy('id', 'DESC')->paginate(10)]);

//                $orders = SalesOrder::query()->where('uid', Auth::user()->id)->where('ShipAddressAddr1','LIKE', '%' . $this->search . '%')->orWhere('uid', Auth::user()->id)->where('TermsRefFullName','LIKE', '%' . $this->search . '%')->orWhere('uid', Auth::user()->id)->where('RefNumber','LIKE', '%' . $this->search . '%')->orderBy('id', 'DESC')->paginate(10);
            }
            else
            {
                return view('livewire.orders', ['orders' => SalesOrder::query()->where('uid', Auth::user()->id)->orderBy('id', 'DESC')->paginate(10)]);
//                $orders = SalesOrder::query()->where('uid', Auth::user()->id)->orderBy('id', 'DESC')->paginate(10);
            }
        }
//        else
//        {
//            return view('livewire.orders', ['orders' => $orders]);
//
//        }
    }

    public function reorder($orderID)
    {
        $items = SalesOrderItem::query()->where('sales_order_id', $orderID)->get();
        $order = SalesOrder::query()->where('id', $orderID)->first();
        foreach ($items as $item)
        {
            $cartItem = new CartItem();
            $cartItem->prod_id = $item->SalesOrderLineItemRefListID;
            $cartItem->qty = round($item->SalesOrderLineQuantity, 0) ;
            $cartItem->uid = Auth::user()->id;
            $cartItem->save();
        }
        return $this->redirect(route('checkout' , 'customerid=' . $order->CustomerRefListID));
    }
}
