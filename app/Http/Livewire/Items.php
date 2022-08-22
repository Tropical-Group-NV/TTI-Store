<?php

namespace App\Http\Livewire;
use App\Models\CartItem;
use http\Params;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Items extends Component
{

    public $brand_srch;
    public $search2;
    public $search_str;
    public $search_sw = 0;
    public $count = 0;
    public $message;
    public $list;
    public $readyToLoad = false;

    protected $listeners =
        [
            'updateCart' => 'render'
        ]
    ;

  public function loadPosts()
    {
         $this->readyToLoad = true;
     }

    public function sug_search()
    {
        if ($this->search_sw == 0)
        {
            if (strlen($this->search2) > 0)
            {
                $this->search_sw = 1;
                {
                    $this->list = DB::connection('epas')->table('item')->where('IsActive', '1')->where('description', 'LIKE', '%' . $this->search2 . '%')->orWhere('BarCodeValue', 'LIKE', '%' . $this->search2 . '%')->orderBy('TimeModified', 'DESC')->limit(10)->get();
                }

            }
        }
        else
        {
            if (strlen($this->search2) > 0)
            {
                {
                    $this->list = DB::connection('epas')->table('item')->where('IsActive', '1')->where('description', 'LIKE', '%' . $this->search2 . '%')->orWhere('BarCodeValue', 'LIKE', '%' . $this->search2 . '%')->orderBy('TimeModified', 'DESC')->limit(10)->get();
                }
            }
        }
    }

    public function mount()
    {
        if (isset($_REQUEST['search']))
        {
            $this->search_str = $_REQUEST['search'];

        }
        if (isset($_REQUEST['brand']))
        {
            $this->brand_srch = $_REQUEST['brand'];
        }
        $this->list = DB::connection('epas')->table('item')->where('IsActive', '1')->where('description', 'LIKE', '%' . $this->search2 . '%')->orderBy('TimeModified', 'DESC')->limit(10)->get();

    }

//    protected $listeners = ['count_up' => 'increment'];



    public function render(Request $request)
    {
//        $items = DB::connection('epas')->table('item')->where('IsActive', '0')->orderBy('TimeModified', 'DESC')->limit(10)->get();
        if ($this->search_str != null or $this->search_str != '')
        {
            if ($this->brand_srch != '' or $this->brand_srch != null)
            {
                return view('livewire.items',
                    [
                        'items' =>  DB::connection('epas')->table('item')->where('IsActive', '1')->where('description', 'LIKE', '%' . $this->search_str . '%')->where('description', 'LIKE', '%' . $this->brand_srch . '%')->orderBy('TimeModified', 'DESC')->paginate(10)
                    ]
                );
            }
            else
            {
                return view('livewire.items',
                    [
                        'items' => DB::connection('epas')->table('item')->where('IsActive', '1')->where('description', 'LIKE', '%' . $this->search_str . '%')->orWhere('BarCodeValue', 'LIKE', '%' . $this->search_str . '%')->orderBy('TimeModified', 'DESC')->paginate(10)

                    ]
                );
            }
        }
        else
        {
            if ($this->search_str == null or $this->search_str == '')
            {
                if ($this->brand_srch != '' or $this->brand_srch != null)
                {
                    return view('livewire.items',
                        [
                            'items' =>  DB::connection('epas')->table('item')->where('IsActive', '1')->where('description', 'LIKE', '%' . $this->search_str . '%')->where('description', 'LIKE', '%' . $this->brand_srch . '%')->orderBy('TimeModified', 'DESC')->paginate(12)
                        ]
                    );
                }
            }

                return view('livewire.items', ['items' => DB::connection('epas')->table('item')->where('IsActive', '1')->orderBy('TimeModified', 'DESC')->paginate(12)]);
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
        }
    }


    public function addMore($cartItemID)
    {
        $item = CartItem::query()->where('id', $cartItemID)->first();
        $item->qty++;
        $item->save();
    }
    public function addLess($cartItemID)
    {
        if (CartItem::query()->where('id', $cartItemID)->exists())
        {
            $item = CartItem::query()->where('id', $cartItemID)->first();
            if ($item->qty == 1)
            {
                $item->delete();
            }
            else
            {
                $item->qty--;
                $item->save();
            }
        }
    }
    public function load($id)
    {
        return null;
    }
    public function load2($id)
    {
        return null;
    }

}
