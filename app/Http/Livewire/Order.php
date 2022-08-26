<?php

namespace App\Http\Livewire;

use App\Models\SalesOrder;
use App\Models\SalesOrderItem;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Http\Request;

class Order extends Component
{
    public $order_id;
    public $order;
    public $order_items;


    public function mount(Request $request)
    {
        $this->order_id = $request->id;
        $this->order = SalesOrder::query()->where('id', $this->order_id)->get()->first();
        $this->order_items = SalesOrderItem::query()->where('sales_order_id', $this->order_id)->get();
    }

    public function render()
    {
        return view('livewire.order');
    }

    public function reorder()
    {
        $items = SalesOrderItem::query()->where('sales_order_id', $this->order_id)->get();
        foreach ($items as $item)
        {
            $cartItem = new Cart();
            $cartItem->prod_id = $item->SalesOrderLineItemRefListID;
            $cartItem->qty = $item->SalesOrderLineQuantity;
            $cartItem->uid = Auth::user()->id;
            $cartItem->save();
        }
         return $this->redirect(route('checkout'));
    }
}
