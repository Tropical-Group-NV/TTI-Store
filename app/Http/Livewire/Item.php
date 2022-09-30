<?php

namespace App\Http\Livewire;

use App\Models\BackOrders;
use App\Models\CartItem;
use App\Models\Customer;
use App\Models\ItemDescription;
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
//        $item = \Illuminate\Support\Facades\DB::connection('epas')->table('item')->where('ListID', $id)->get()->first();
        $item = \App\Models\Item::query()->where('ListID', $id)->first();
        $itemdesc = ItemDescription::query()->where('item_id', $id)->get()->first();
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
            $this->dispatchBrowserEvent('addedcart', ['message' => 'Added to cart']);
        }
    }

    public function addBackorder($itm, $qty, $cID)
    {
        $customer = Customer::query()->where('ListID', $cID)->first();
        $bo = new BackOrders();
        $bo->CustomerRefListID = $cID;
        $bo->ListID = $itm;
        $bo->OrderQuantity = 0;
        $bo->BackOrderQuantity = $qty;
        $bo->uid = Auth::user()->id;
        $bo->email = $customer->Email;
        $bo->mail_is_send = null;
        $bo->mail_send_date_time = null;
        $bo->QuantityOnHandOnCreated = 0;
        $bo->QuantityOnHandOnMailSend = null;
        $bo->first_mail_is_send = null;
        $bo->save();
        if ($bo->save())
        {
            $this->dispatchBrowserEvent('addedbo', ['message' => 'Added to backorder']);
//            \App\Jobs\BackOrdersNotification::dispatch();
        }
        else
        {
            $this->dispatchBrowserEvent('update', ['message' => 'Failed']);
        }
    }
}
