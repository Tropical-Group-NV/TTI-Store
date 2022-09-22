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
    public $popularItemsCount = 8;
    public $leastPopularItems;
    public $leastPopularItemsCount = 8;
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
        return view('livewire.home', ['onSale' => $this->onSale]);
    }

    public function hydrate()
    {

    }

    public function boot()
    {
        $this->randomItems = DB::table('most_sold_items')->limit($this->popularItemsCount)->get();
//        $this->popularItems = DB::connection('qb_sales')->table('sales_order_items')
//            ->select('SalesOrderLineItemRefListID', DB::raw('COUNT(SalesOrderLineItemRefListID) AS occurrences'))
//            ->groupBy('SalesOrderLineItemRefListID')
//            ->orderBy('occurrences', 'DESC')
////            ->limit($this->popularItemsCount)
//            ->get();
        $this->popularItems = DB::table('most_sold_items')->limit($this->popularItemsCount)->get();
//        $this->leastPopularItems = DB::connection('qb_sales')->table('sales_order_items')
//            ->select('SalesOrderLineItemRefListID', DB::raw('COUNT(SalesOrderLineItemRefListID) AS occurrences'))
//            ->groupBy('SalesOrderLineItemRefListID')
//            ->inRandomOrder()
//            ->limit($this->leastPopularItemsCount)
//            ->get();
        $this->leastPopularItems = DB::table('most_sold_items')->limit($this->popularItemsCount)->get();

//        foreach ($this->popularItems as $items)
//        {
//            DB::table('most_sold_items')->insert(['itemID'=> $items->SalesOrderLineItemRefListID, 'qty' => $items->occurrences]);
//        }

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
        $this->restocked = \App\Models\Item::query()->orderBy('TimeModified' , 'DESC')->limit(4)->get();
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
        if ($this->popularItemsCount < 50)
        {
            $this->popularItemsCount = $this->popularItemsCount * 2;
            $this->popularItems = DB::table('most_sold_items')->limit($this->popularItemsCount)->get();
//            $this->popularItems = DB::connection('qb_sales')->table('sales_order_items')
//                ->select('SalesOrderLineItemRefListID', DB::raw('COUNT(SalesOrderLineItemRefListID) AS occurrences'))
//                ->groupBy('SalesOrderLineItemRefListID')
//                ->orderBy('occurrences', 'DESC')
//                ->limit($this->popularItemsCount)
//                ->get();
            $this->emit('showMore');
        }
    }
    public function leastPopularItemsCountAdd()
    {
        $this->leastPopularItemsCount = $this->leastPopularItemsCount * 2;
//        $this->leastPopularItems = DB::connection('qb_sales')->table('sales_order_items')
//            ->select('SalesOrderLineItemRefListID', DB::raw('COUNT(SalesOrderLineItemRefListID) AS occurrences'))
//            ->groupBy('SalesOrderLineItemRefListID')
//            ->orderBy('occurrences', 'ASC')
////            ->orderBy(DB::raw('RAND()'))
//            ->limit($this->leastPopularItemsCount)
//            ->get();
        $this->emit('showMore');
    }

    public function load($id)
    {
        return null;
    }
}
