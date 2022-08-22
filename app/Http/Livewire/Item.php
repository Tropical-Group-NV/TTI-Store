<?php

namespace App\Http\Livewire;

use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class Item extends Component
{
    protected $listeners =
        [
            'updateCart' => 'render'
        ]
    ;
    public $item_id;

    public function mount(Request $request)
    {
        $this->item_id = $request->id;
    }

    public function render(Request $request)
    {
        $requested_id = $this->item_id;
        $id = $requested_id;
        $item = \Illuminate\Support\Facades\DB::connection('epas')->table('item')->where('ListID', $id)->get()->first();
        $itemdesc = \Illuminate\Support\Facades\DB::connection('qb_sales')->table('item_description')->where('item_id', $id)->get()->first();
        $images = \Illuminate\Support\Facades\DB::connection('qb_sales')->table('item_images')->where('item_id', $id)->get();
        return view('livewire.item', [
            'id' => $id,
            'item' => $item,
            'itemdesc' => $itemdesc,
            'images' => $images
        ]);
    }

    public function addToCart($prod, $qty)
    {
        if ($qty <= 0 or is_int($qty))
        {
            return 'no vAlue';
        }
        else
        {
            $item = new CartItem();
            $item->prod_id = $prod;
            $item->qty = $qty;
            $item->uid = Auth::user()->id;
            $item->save();
            $this->emit('updateCart');
            $Request = new Request();
            $Request->setMethod('GET');
            $Request->request->add([
                'id' => $prod,
            ]);
            $this->render($Request);
        }
    }
}
