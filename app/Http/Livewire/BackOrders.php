<?php

namespace App\Http\Livewire;

use App\Models\CartItem;
use App\Models\BackOrders as BO;
use App\Models\SalesOrder;
use App\Models\SalesOrderItem;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class BackOrders extends Component
{
    use WithPagination;

//    public $backorders;

    protected $listeners =
        [
            'deletedBO' => 'render'
        ]
    ;


    public function mount()
    {
        if (Auth::user() != null)
        {
//            $this->backorders = \App\Models\BackOrders::query()->where('uid', Auth::user()->id)->get();

        }

    }
    public function render()
    {
        return view('livewire.back-orders');
    }

    public function delete($itemID)
    {
        BO::find($itemID)->delete($itemID);
//        BO::query()->where('id', $itemID)->delete();
        $this->emit('deletedBO');
    }
    public function createOrder($itemID, $qty, $customerID)
    {
        $item = \App\Models\Item::query()->where('ListId', $itemID)->first();
        CartItem::query()->where('uid', Auth::user()->id)->delete();
        $cartItem= new CartItem();
        $cartItem->prod_id = $itemID;
        $cartItem->qty = $qty;
        $cartItem->uid = Auth::user()->id;
        $cartItem->save();
        return $this->redirect(route('checkout' , 'customerid=' . $customerID));
    }
}
