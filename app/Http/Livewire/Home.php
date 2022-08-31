<?php

namespace App\Http\Livewire;

use App\Models\CartItem;
use App\Models\OnSale;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Home extends Component
{
    public $onSale;
    public $brand_srch;
    public $search2;
    public $search_str;
    public $search_sw = 0;
    public $count = 0;
    public $message;
    public $list;
    public $readyToLoad = false;

    public function render()
    {
        return view('livewire.home');
    }

    public function mount()
    {
        $this->onSale = OnSale::query()->get();
        $this->list = DB::connection('qb_sales')->table('view_item')->where('IsActive', '1')->where('description', 'LIKE', '%' . $this->search2 . '%')->orderBy('TimeModified', 'DESC')->limit(12)->get();

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
        }
    }

    public function load($id)
    {
        return null;
    }
}
