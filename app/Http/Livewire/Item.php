<?php

namespace App\Http\Livewire;

use Illuminate\Http\Request;
use Livewire\Component;

class Item extends Component
{
    public function render(Request $request)
    {
        $id = $request->id;
        return view('livewire.item', ['id' => $id]);
    }
}
