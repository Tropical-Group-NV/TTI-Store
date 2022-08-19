<?php

namespace App\Http\Livewire;

use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Sidebar extends Component
{
    protected $listeners =
        [
            'updateCart' => 'render'
        ]
    ;
    public function render()
    {
        $cartItems = CartItem::query()->where('uid', Auth::user()->id)->get();
        $cartItemExist = CartItem::query()->where('uid', Auth::user()->id)->exists();
        return view('livewire.sidebar', ['cartItems' => $cartItems, 'cartItemExist' => $cartItemExist]);
    }

    public function removeFromCart($cartItemID)
    {
        $item = CartItem::query()->where('id', $cartItemID)->first();
        $item->delete();
        $this->emit('updateCart');
    }


    public function changeQuantityCart($cartItemID, $qty)
    {
        if ($qty <= 0 or is_int($qty))
        {

        }
        else
        {
            $item = CartItem::query()->where('id', $cartItemID)->first();
            $item->qty = $qty;
            $item->save();
            $this->emit('updateCart');
        }
    }

    public function changeQuantity($id, $qty)
    {
        $item = CartItem::query()->where('id', $id)->first();
        $item->qty = $qty;
        $item->save();
    }

    public function clearCart()
    {
        $item = CartItem::query()->where('uid', Auth::user()->id)->delete();
        $this->emit('updateCart');

    }
}
