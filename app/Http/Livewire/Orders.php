<?php

namespace App\Http\Livewire;

use App\Models\SalesOrder;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Orders extends Component
{
    public $orders;

    public function mount()
    {
        if (Auth::user() != null)
        {
            $this->orders = SalesOrder::query()->where('uid', Auth::user()->id)->get();

        }

    }

    public function render()
    {
        return view('livewire.orders');
    }
}
