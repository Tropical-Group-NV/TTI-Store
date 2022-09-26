<?php

namespace App\Http\Livewire;

use App\Models\CartItem;
use App\Models\OnSale;
use App\Models\SalesOrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Home extends Component
{
    public $saleUnlimit;
//    public $onSale;
    public $readyToLoadRandom = false;
    public $readyToLoadPopular = false;
    public $readyToLoadNewStock = false;
//    protected $restocked;
    public $popularItems;
    protected $popularItemsCount = 8;
    public $randomItems;

    protected $listeners =
        [
            'showMore' => 'render',
            'updateCart' => 'render',
            'hydrate' => 'mount'
        ]
    ;

    public function render()
    {
//        $randomItems = $this->readyToLoadRandom ? \App\Models\Item::query()->where('IsActive', 1)->where('Type', 'ItemInventory')->where('QuantityOnHand', '>', 0)->limit(8)->inRandomOrder()->get() :  [];
//        $popularItems = $this->readyToLoadPopular ? DB::table('most_sold_items')->limit($this->popularItemsCount)->get() : [];
        if ($this->saleUnlimit == 1)
        {
            $onSale = OnSale::query()->where('onsale', 1)->get();

        }
        else
        {
            $onSale = OnSale::query()->where('onsale', 1)->limit(4)->get();
        }
        $restocked = \App\Models\Item::query()->orderBy('TimeModified' , 'DESC')->limit(4)->get();
        return view('livewire.home', ['onSale' => $onSale, 'restocked' => $restocked]);
    }

    public function loadPopularItems()
    {
        $this->readyToLoadPopular = true;
        $this->popularItems = DB::table('most_sold_items')->limit($this->popularItemsCount)->get();
    }

    public function loadRandomItems()
    {
        $this->readyToLoadRandom = true;
        $this->randomItems = \App\Models\Item::query()->where('IsActive', 1)->where('Type', 'ItemInventory')->where('QuantityOnHand', '>', 0)->limit(8)->inRandomOrder()->get();
    }

    public function hydrate()
    {

    }

    public function boot()
    {
        $this->randomItems = [];
        $this->popularItems = [];
    }

    public function mount()
    {

//        if ($this->saleUnlimit == 1)
//        {
//            $this->onSale = OnSale::query()->where('onsale', 1)->get();
//
//        }
//        else
//        {
//            $this->onSale = OnSale::query()->where('onsale', 1)->limit(4)->get();
//        }
//        $this->restocked = \App\Models\Item::query()->orderBy('TimeModified' , 'DESC')->limit(4)->get();

    }

    public function saleUnlimited()
    {
        $this->saleUnlimit = 1;
        $this->onSale = OnSale::query()->get();
        $this->emit('showMore');
    }
    public function saleLimited()
    {
        $this->saleUnlimit = 0;
        $this->onSale = OnSale::query()->limit(6)->get();
        $this->emit('showMore');
    }
    public function addToCart($prod, $qty)
    {
        if ($qty > 0 or !is_int($qty))
        {
            $item = new CartItem();
            $item->prod_id = $prod;
            $item->qty = $qty;
            $item->uid = Auth::user()->id;
            $item->save();
            $this->emit('updateCart');
            $this->dispatchBrowserEvent('addedcart', ['message' => 'Added to cart']);

        }
    }

    public function popularItemsCountAdd()
    {
        if ($this->popularItemsCount < 50)
        {
            $this->popularItemsCount = $this->popularItemsCount * 2;
            $this->popularItems = DB::table('most_sold_items')->limit($this->popularItemsCount)->get();
            $this->emit('showMore');
        }
    }

    public function load($id)
    {
        return null;
    }
}
