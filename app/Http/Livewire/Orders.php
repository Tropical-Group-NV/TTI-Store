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
    use WithPagination;
//    public $orders;

    public function mount()
    {
        if (Auth::user() != null)
        {
//            $this->orders = SalesOrder::query()->where('uid', Auth::user()->id)->orderBy('id', 'DESC');

        }

    }

    public function render()
    {
        $orders = SalesOrder::query()->where('uid', Auth::user()->id)->orderBy('id', 'DESC')->paginate(10);
        return view('livewire.orders', ['orders' => $orders]);
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
