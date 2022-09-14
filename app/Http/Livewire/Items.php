<?php

namespace App\Http\Livewire;
use App\Models\BackOrders;
use App\Models\CartItem;
use App\Models\Customer;
use http\Params;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Items extends Component
{
    use WithPagination;

    public $notification_sw;
    public $srch_sw;
    public $search_customer;
    public $brand_srch;
    public $unitsearch;
    public $branchsearch;
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
        if (isset($_REQUEST['branch']))
        {
            $this->branchsearch = $_REQUEST['branch'];
        }
        if (isset($_REQUEST['unit']))
        {
            $this->unitsearch = $_REQUEST['unit'];
        }

    }



    public function render(Request $request)
    {
        if ($this->brand_srch != '' or $this->brand_srch != null)
        {
            if ($this->branchsearch != null and $this->branchsearch != '')
            {
                if ($this->unitsearch != null and $this->unitsearch != '')
                {

                    return view('livewire.items',
                        [
                            'items' =>  DB::connection('qb_sales')->table('view_item')->where('CustomFieldBranch', 'LIKE', '%' . $this->branchsearch . '%')->where('IsActive', '1')->where('description', 'LIKE', '%' . $this->brand_srch . '%')->where('UnitOfMeasureSetRefFullName', $this->unitsearch)->orWhere('CustomFieldBranch2', 'LIKE', '%' . $this->branchsearch . '%')->where('IsActive', '1')->where('description', 'LIKE', '%' . $this->brand_srch . '%')->where('UnitOfMeasureSetRefFullName', $this->unitsearch)->orWhere('CustomFieldBranch3', 'LIKE', '%' . $this->branchsearch . '%')->where('IsActive', '1')->where('description', 'LIKE', '%' . $this->brand_srch . '%')->where('UnitOfMeasureSetRefFullName', $this->unitsearch)->orWhere('CustomFieldBranch4', 'LIKE', '%' . $this->branchsearch . '%')->where('IsActive', '1')->where('description', 'LIKE', '%' . $this->brand_srch . '%')->where('UnitOfMeasureSetRefFullName', $this->unitsearch)->orWhere('CustomFieldBranch5', 'LIKE', '%' . $this->branchsearch . '%')->where('IsActive', '1')->where('description', 'LIKE', '%' . $this->brand_srch . '%')->where('UnitOfMeasureSetRefFullName', $this->unitsearch)->orderBy('Description')->paginate($_REQUEST['totalpage'])
                        ]
                    );
                }
                else
                {
//                    die($this->brand_srch);
                    return view('livewire.items',
                        [
                            'items' =>  DB::connection('qb_sales')->table('view_item')->where('CustomFieldBranch', 'LIKE', '%' . $this->branchsearch . '%')->where('IsActive', '1')->where('description', 'LIKE', '%' . $this->brand_srch . '%')->orWhere('CustomFieldBranch2', 'LIKE', '%' . $this->branchsearch . '%')->where('IsActive', '1')->where('description', 'LIKE', '%' . $this->brand_srch . '%')->orWhere('CustomFieldBranch3', 'LIKE', '%' . $this->branchsearch . '%')->where('IsActive', '1')->where('description', 'LIKE', '%' . $this->brand_srch . '%')->orWhere('CustomFieldBranch4', 'LIKE', '%' . $this->branchsearch . '%')->where('IsActive', '1')->where('description', 'LIKE', '%' . $this->brand_srch . '%')->orWhere('CustomFieldBranch5', 'LIKE', '%' . $this->branchsearch . '%')->where('IsActive', '1')->where('description', 'LIKE', '%' . $this->brand_srch . '%')->orderBy('Description')->paginate($_REQUEST['totalpage'])
                        ]
                    );
                }
            }
            else
            {
                if ($this->unitsearch != null and $this->unitsearch != '') {

                    return view('livewire.items',
                        [
                            'items' => DB::connection('qb_sales')->table('view_item')->where('IsActive', '1')->where('description', 'LIKE', '%' . $this->brand_srch . '%')->where('UnitOfMeasureSetRefFullName', $this->unitsearch)->orderBy('Description')->paginate($_REQUEST['totalpage'])
                        ]
                    );

                }
                return view('livewire.items',
                    [
                        'items' =>  DB::connection('qb_sales')->table('view_item')->where('IsActive', '1')->where('description', 'LIKE', '%' . $this->brand_srch . '%')->orderBy('Description')->paginate($_REQUEST['totalpage'])
                    ]
                );
            }
        }
        else
        {
            if ($this->unitsearch != null and $this->unitsearch != '')
            {
                if ($this->branchsearch != null and $this->branchsearch != '')
                {
                    return view('livewire.items',
                        [
                            'items' => DB::connection('qb_sales')->table('view_item')->where('CustomFieldBranch', 'LIKE', '%' . $this->branchsearch . '%')->where('IsActive', '1')->where('UnitOfMeasureSetRefFullName', $this->unitsearch)->orWhere('CustomFieldBranch2', 'LIKE', '%' . $this->branchsearch . '%')->where('IsActive', '1')->where('UnitOfMeasureSetRefFullName', $this->unitsearch)->orWhere('CustomFieldBranch3', 'LIKE', '%' . $this->branchsearch . '%')->where('IsActive', '1')->where('UnitOfMeasureSetRefFullName', $this->unitsearch)->orWhere('CustomFieldBranch4', 'LIKE', '%' . $this->branchsearch . '%')->where('IsActive', '1')->where('UnitOfMeasureSetRefFullName', $this->unitsearch)->orWhere('CustomFieldBranch5', 'LIKE', '%' . $this->branchsearch . '%')->where('IsActive', '1')->where('UnitOfMeasureSetRefFullName', $this->unitsearch)->orderBy('Description')->paginate($_REQUEST['totalpage'])
                        ]
                    );
                }
                return view('livewire.items',
                    [
                        'items' => DB::connection('qb_sales')->table('view_item')->where('IsActive', '1')->where('UnitOfMeasureSetRefFullName', $this->unitsearch)->orderBy('Description')->paginate($_REQUEST['totalpage'])
                    ]
                );
            }
            else
            {
                if ($this->branchsearch != null and $this->branchsearch != '')
                {
                    return view('livewire.items',
                        [
                            'items' => DB::connection('qb_sales')->table('view_item')->where('CustomFieldBranch', 'LIKE', '%' . $this->branchsearch . '%')->where('IsActive', '1')->orWhere('CustomFieldBranch2', 'LIKE', '%' . $this->branchsearch . '%')->where('IsActive', '1')->orWhere('CustomFieldBranch3', 'LIKE', '%' . $this->branchsearch . '%')->where('IsActive', '1')->orWhere('CustomFieldBranch4', 'LIKE', '%' . $this->branchsearch . '%')->where('IsActive', '1')->orWhere('CustomFieldBranch5', 'LIKE', '%' . $this->branchsearch . '%')->where('IsActive', '1')->paginate($_REQUEST['totalpage'])
                        ]
                    );
                }
            }
        }
        if ($this->search_str != null or $this->search_str != '')
        {
            if ($this->brand_srch != '' or $this->brand_srch != null)
            {
                return view('livewire.items',
                    [
                        'items' =>  DB::connection('qb_sales')->table('view_item')->where('IsActive', '1')->where('description', 'LIKE', '%' . $this->search_str . '%')->where('description', 'LIKE', '%' . $this->brand_srch . '%')->orderBy('TimeModified', 'DESC')->paginate($_REQUEST['totalpage'])->appends(request()->query())
                    ]
                );
            }
            else
            {
                return view('livewire.items',
                    [
                        'items' => DB::connection('qb_sales')->table('view_item')->where('IsActive', '1')->where('description', 'LIKE', '%' . $this->search_str . '%')->orWhere('BarCodeValue', 'LIKE', '%' . $this->search_str . '%')->orderBy('TimeModified', 'DESC')->paginate(12)->appends(request()->query())

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
                            'items' =>  DB::connection('qb_sales')->table('view_item')->where('IsActive', '1')->where('description', 'LIKE', '%' . $this->search_str . '%')->where('description', 'LIKE', '%' . $this->brand_srch . '%')->orderBy('TimeModified', 'DESC')->paginate(12)->appends(request()->query())
                        ]
                    );
                }
            }

        }
        return view('livewire.items', ['items' => DB::connection('qb_sales')->table('view_item')->where('IsActive', '1')->orderBy('TimeModified', 'DESC')->paginate(12)->appends(request()->query())]);


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
            $this->notification_sw = 1;
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

    public function search()
    {
        $this->search_sw = 1;
        $this->customers = DB::connection('epas')->table('QB_Customer')->where('ISActive', 1)->where('Name', 'LIKE', '%' . $this->search_customer . '%')->orderBy('Name', 'ASC')->limit(10)->get();
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
