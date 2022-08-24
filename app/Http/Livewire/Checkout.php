<?php

namespace App\Http\Livewire;

use App\Models\CartItem;
use App\Models\Customer;
use App\Models\Term;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use phpDocumentor\Reflection\Types\This;

class Checkout extends Component
{
    public $customers;
    public $search_customer;
    public $search_sw;
    public $terms;

    public function mount()
    {
//        $this->terms = Term::all();
//        $this->customers = Customer::query()->orderBy('text', 'ASC')->get();
    }

    protected $listeners =
        [
            'updateCart' => 'render'
        ]
    ;
    public function render()
    {
        $cartItems = CartItem::query()->where('uid', Auth::user()->id)->get();
        $cartItemExist = CartItem::query()->where('uid', Auth::user()->id)->exists();
        return view('livewire.checkout', ['cartItems' => $cartItems, 'cartItemExist' => $cartItemExist]);
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

    public function search()
    {
            $this->search_sw = 1;
            $this->customers = DB::connection('epas')->table('QB_Customer')->where('ISActive', 1)->where('Name', 'LIKE', '%' . $this->search_customer . '%')->orderBy('Name', 'ASC')->limit(10)->get();
    }
}
