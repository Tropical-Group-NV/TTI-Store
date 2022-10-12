<?php

namespace App\Http\Livewire;
use App\Models\BackOrders;
use App\Models\CartItem;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Items extends Component
{
    use WithPagination;
    public $itemsPerPage;
    public $brand_srch;
    public $unitsearch;
    public $branchsearch;
    public $search_str;
    public $exchangeRate;
    protected $listeners =
        [
            'updateCart' => 'render'
        ];
    public function mount()
    {
        if (isset($_REQUEST['search']))
        {
            $this->search_str = $_REQUEST['search'];

        }
        else
        {
            $this->search_str = '';
        }
        if (isset($_REQUEST['brand']))
        {
            $this->brand_srch = $_REQUEST['brand'];
        }
        else
        {
            $this->brand_srch = '';
        }
        if (isset($_REQUEST['branch']))
        {
            $this->branchsearch = $_REQUEST['branch'];
        }
        if (isset($_REQUEST['unit']))
        {
            $this->unitsearch = $_REQUEST['unit'];
        }
        if (isset($_REQUEST['totalpage']))
        {
            $this->itemsPerPage = $_REQUEST['totalpage'];
        }
        else
        {
            $this->itemsPerPage = 24;
        }
        if (session()->has('currency') and session()->has('exchangeRate'))
        {
            $this->exchangeRate = session()->get('exchangeRate');
        }

    }



    public function render(Request $request)
    {
        if($this->brand_srch == '' and $this->branchsearch== '' and $this->unitsearch == '')
        {
            if ($this->search_str == '')
            {
                return view('livewire.items',
                    [
//                        'items' => DB::connection('qb_sales')->table('view_item')->where('IsActive', '1')->where('description', 'LIKE', '%' . $this->search_str . '%')->where('type', 'ItemInventory')->orWhere('FullName', 'LIKE', '%' . $this->search_str . '%')->where('type', 'ItemInventory')->orderBy('Description', 'ASC')->paginate($this->itemsPerPage)->appends(request()->query())
                        'items' => DB::table('most_sold_items')->paginate($this->itemsPerPage)->appends(request()->query())

                    ]
                );
            }
            else
            {
                return view('livewire.items',
                    [
                        'items' => DB::connection('qb_sales')->table('view_item')->where('IsActive', '1')->where('description', 'LIKE', '%' . $this->search_str . '%')->where('type', 'ItemInventory')->orWhere('FullName', 'LIKE', '%' . $this->search_str . '%')->where('type', 'ItemInventory')->orderBy('Description', 'ASC')->paginate($this->itemsPerPage)->appends(request()->query())
//                        'items' => DB::table('most_sold_items')->paginate($this->itemsPerPage)->appends(request()->query())

                    ]
                );
            }

        }
        if ($this->unitsearch != '')
        {
            return view('livewire.items',
                [
                    'items' =>  DB::connection('qb_sales')->table('view_item')->where('CustomFieldBranch', 'LIKE', '%' . $this->branchsearch . '%')->where('description', 'LIKE', '%' . $this->search_str . '%')->where('FullName', 'LIKE', '%' . $this->search_str . '%')->where('IsActive', '1')->where('description', 'LIKE', '%' . $this->brand_srch . '%')->where('UnitOfMeasureSetRefFullName', $this->unitsearch)->where('type', 'ItemInventory')->orWhere('CustomFieldBranch2', 'LIKE', '%' . $this->branchsearch . '%')->where('description', 'LIKE', '%' . $this->search_str . '%')->where('IsActive', '1')->where('description', 'LIKE', '%' . $this->brand_srch . '%')->where('UnitOfMeasureSetRefFullName', $this->unitsearch)->where('type', 'ItemInventory')->orWhere('CustomFieldBranch3', 'LIKE', '%' . $this->branchsearch . '%')->where('description', 'LIKE', '%' . $this->search_str . '%')->where('IsActive', '1')->where('description', 'LIKE', '%' . $this->brand_srch . '%')->where('UnitOfMeasureSetRefFullName', $this->unitsearch)->where('type', 'ItemInventory')->orWhere('CustomFieldBranch4', 'LIKE', '%' . $this->branchsearch . '%')->where('description', 'LIKE', '%' . $this->search_str . '%')->where('IsActive', '1')->where('description', 'LIKE', '%' . $this->brand_srch . '%')->where('UnitOfMeasureSetRefFullName', $this->unitsearch)->where('type', 'ItemInventory')->orWhere('CustomFieldBranch5', 'LIKE', '%' . $this->branchsearch . '%')->where('description', 'LIKE', '%' . $this->search_str . '%')->where('IsActive', '1')->where('description', 'LIKE', '%' . $this->brand_srch . '%')->where('UnitOfMeasureSetRefFullName', $this->unitsearch)->where('type', 'ItemInventory')->orderBy('Description')->paginate($this->itemsPerPage)
                ]
            );
        }
        else
        {
            return view('livewire.items',
                [
                    'items' =>  DB::connection('qb_sales')->table('view_item')->where('CustomFieldBranch', 'LIKE', '%' . $this->branchsearch . '%')->where('description', 'LIKE', '%' . $this->search_str . '%')->where('IsActive', '1')->where('description', 'LIKE', '%' . $this->brand_srch . '%')->where('type', 'ItemInventory')->orWhere('CustomFieldBranch2', 'LIKE', '%' . $this->branchsearch . '%')->where('description', 'LIKE', '%' . $this->search_str . '%')->where('IsActive', '1')->where('description', 'LIKE', '%' . $this->brand_srch . '%')->where('type', 'ItemInventory')->orWhere('CustomFieldBranch3', 'LIKE', '%' . $this->branchsearch . '%')->where('description', 'LIKE', '%' . $this->search_str . '%')->where('IsActive', '1')->where('description', 'LIKE', '%' . $this->brand_srch . '%')->where('type', 'ItemInventory')->orWhere('CustomFieldBranch4', 'LIKE', '%' . $this->branchsearch . '%')->where('description', 'LIKE', '%' . $this->search_str . '%')->where('IsActive', '1')->where('description', 'LIKE', '%' . $this->brand_srch . '%')->where('type', 'ItemInventory')->orWhere('CustomFieldBranch5', 'LIKE', '%' . $this->branchsearch . '%')->where('description', 'LIKE', '%' . $this->search_str . '%')->where('IsActive', '1')->where('description', 'LIKE', '%' . $this->brand_srch . '%')->where('type', 'ItemInventory')->orderBy('Description')->paginate($this->itemsPerPage)
                ]
            );
        }
    }

    public function addToCart($prod, $qty, Request $request)
    {
        if (!CartItem::query()->where('uid', Auth::user()->id)->where('prod_id', $prod)->exists())
        {
            if ($qty == '' or $qty == null)
            {
                session()->flash('key', 'value');
                $item = new CartItem();
                $item->prod_id = $prod;
                $item->qty = 1;
                $item->uid = Auth::user()->id;
                $item->save();
                $this->emit('updateCart');
                $this->dispatchBrowserEvent('addedcart', ['message' => 'Added to cart']);
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

    public function load($id)
    {
        return null;
    }
    public function load2($id)
    {
        return null;
    }

}
