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
    public $onSale;
    public $brand_srch;
    public $search2;
    public $search_str;
    public $search_sw = 0;
    public $count = 0;
    public $message;
    public $list;
    public $readyToLoad = false;
    public $restocked;
    public $popularItems;
    public $popularItemsCount = 12;

    protected $listeners =
        [
            'showMore' => 'render',
            'updateCart' => 'render',
            'hydrate' => 'mount'
        ]
    ;

    public function render()
    {
        return view('livewire.home', ['onSale' => $this->onSale]);
    }

    public function hydrate()
    {

    }

    public function boot()
    {
        $this->popularItems = DB::connection('qb_sales')->table('sales_order_items')
            ->select('SalesOrderLineItemRefListID', DB::raw('COUNT(SalesOrderLineItemRefListID) AS occurrences'))
            ->groupBy('SalesOrderLineItemRefListID')
            ->orderBy('occurrences', 'DESC')
            ->limit($this->popularItemsCount)
            ->get();
    }

    public function mount()
    {

        if ($this->saleUnlimit == 1)
        {
            $this->onSale = OnSale::query()->get();

        }
        else
        {
            $this->onSale = OnSale::query()->limit(6)->get();

        }
        $this->restocked = \App\Models\Item::query()->orderBy('TimeModified' , 'DESC')->limit(8)->get();
        $this->list = DB::connection('qb_sales')->table('view_item')->where('IsActive', '1')->where('description', 'LIKE', '%' . $this->search2 . '%')->orderBy('TimeModified', 'DESC')->limit(12)->get();


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

    public function sug_search()
    {
        if ($this->search_sw == 0)
        {
            if (strlen($this->search2) > 0)
            {
                $this->search_sw = 1;
                {
                    $this->list = DB::connection('qb_sales')->table('view_item')->where('IsActive', '1')->where('description', 'LIKE', '%' . $this->search2 . '%')->orWhere('BarCodeValue', 'LIKE', '%' . $this->search2 . '%')->orderBy('TimeModified', 'DESC')->limit(10)->get();
                }

            }
        }
        else
        {
            if (strlen($this->search2) > 0)
            {
                {
                    $this->list = DB::connection('qb_sales')->table('view_item')->where('IsActive', '1')->where('description', 'LIKE', '%' . $this->search2 . '%')->orWhere('BarCodeValue', 'LIKE', '%' . $this->search2 . '%')->orderBy('TimeModified', 'DESC')->limit(10)->get();
                }
            }
        }
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
            $this->dispatchBrowserEvent('addedcart', ['message' => 'Added to cart']);

        }
    }

    public function popularItemsCountAdd()
    {
        $this->popularItemsCount = $this->popularItemsCount * 2;
        $this->popularItems = DB::connection('qb_sales')->table('sales_order_items')
            ->select('SalesOrderLineItemRefListID', DB::raw('COUNT(SalesOrderLineItemRefListID) AS occurrences'))
            ->groupBy('SalesOrderLineItemRefListID')
            ->orderBy('occurrences', 'DESC')
            ->limit($this->popularItemsCount)
            ->get();
        $this->emit('showMore');
    }

    public function load($id)
    {
        return null;
    }
}
