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
        $this->dispatchBrowserEvent('removedcart', ['message' => 'Added to cart']);

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
            $this->dispatchBrowserEvent('qtyupdate', ['message' => 'Added to cart']);

        }
    }

    public function changeQuantity($id, $qty)
    {
        $item = CartItem::query()->where('id', $id)->first();
        $item->qty = $qty;
        $item->save();
        $this->dispatchBrowserEvent('qtyupdate', ['message' => 'Added to cart']);

    }

    public function clearCart()
    {

        $items = CartItem::query()->where('uid', Auth::user()->id)->get();
        foreach ($items as $item)
        {
            CartItem::find($item->id)->delete();
        }
        $this->emit('updateCart');
        $this->dispatchBrowserEvent('clearcart', ['message' => 'Added to cart']);


    }
}
