<?php

namespace App\Http\Livewire;

use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Sidebar extends Component
{
    public function render()
    {
        $cartItems = CartItem::query()->where('uid', Auth::user()->id)->get();
        return view('livewire.sidebar', ['cartItems' => $cartItems]);
    }
}
