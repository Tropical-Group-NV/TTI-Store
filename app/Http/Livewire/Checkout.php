<?php

namespace App\Http\Livewire;

use App\Jobs\Import_Sales_Order_To_QB;
use App\Jobs\SendFirstOrderMail;
use App\Models\CartItem;
use App\Models\CustomerMessage;
use App\Models\QbCustomer;
use App\Models\SalesOrderItem;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\SalesOrder;
use App\Models\Term;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use phpDocumentor\Reflection\Types\This;

class Checkout extends Component
{
    public $srch_sw;
    public $customer_id;
    public $term_id;
    public $msg_id;
    public $memo;
    public $date;
    public $customers;
    public $search_customer;
    public $search_sw;
    public $terms;
    public $status_msg;

    public function mount()
    {
        $this->date= date('Y-m-d');
        $this->srch_sw= 'dewfwqfqf';
    }

    protected $listeners =
        [
            'updateCart' => 'render'
        ]
    ;
    public function render()
    {
        $cartItems = CartItem::query()->where('uid', Auth::user()->id)->get();
        $cartItemExist = CartItem::query()->where('uid', Auth::user()->id)->exists();
        return view('livewire.checkout', ['cartItems' => $cartItems, 'cartItemExist' => $cartItemExist]);
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
            $this->emit('updateCart');
        }
    }

    public function changeQuantity($id, $qty)
    {
        $item = CartItem::query()->where('id', $id)->first();
        $item->qty = $qty;
        $item->save();
    }

    public function clearCart()
    {
        $item = CartItem::query()->where('uid', Auth::user()->id)->delete();
        $this->emit('updateCart');

    }

    public function search()
    {
            $this->search_sw = 1;
            $this->customers = DB::connection('epas')->table('QB_Customer')->where('ISActive', 1)->where('Name', 'LIKE', '%' . $this->search_customer . '%')->orderBy('Name', 'ASC')->limit(10)->get();
    }

    public function createSalesOrder(Request $request)
    {
        $cartItems = CartItem::query()->where('uid', Auth::user()->id)->get();
        $customer = DB::connection('epas')->table('QB_Customer')->where('ListID', $this->customer_id)->first();
        if ($this->msg_id != '')
        {
            $cst_msg = CustomerMessage::query()->where('ListID', $this->msg_id)->get()->first();
        }
        $term = Term::query()->where('ListID', $this->term_id)->get()->first();
        $sale = new SalesOrder();
        $sale->CustomerRefListID = $customer->ListID;
        $sale->TxnDate = date("Y/m/d");
        $sale->BillAddressAddr1 = $customer->BillAddressBlockAddr1;
        $sale->BillAddressAddr2 = $customer->BillAddressBlockAddr2;
        $sale->BillAddressAddr3 = $customer->BillAddressBlockAddr3;
        $sale->BillAddressAddr4 = $customer->BillAddressBlockAddr4;
        $sale->BillAddressAddr5 = $customer->BillAddressBlockAddr5;
        $sale->ShipAddressAddr1 = $customer->BillAddressBlockAddr1;
        $sale->ShipAddressAddr2 = $customer->BillAddressBlockAddr2;
        $sale->ShipAddressAddr3 = $customer->BillAddressBlockAddr3;
        $sale->ShipAddressAddr4 = $customer->BillAddressBlockAddr4;
        $sale->ShipAddressAddr5 = $customer->BillAddressBlockAddr5;
        if ($this->msg_id != '')
        {
            $sale->CustomerMsgRefListID = $cst_msg->ListID;
            $sale->CustomerMsgRefFullName = $cst_msg->Name;
        }

        $sale->uid = Auth::user()->id;
        $sale->TermsRefListID = $term->ListID;
        $sale->TermsRefFullName = $term->Name;
        $sale->ShipDate = $this->date;
        $sale->Memo = $this->memo;
        $sale->save();
        foreach ($cartItems as $cartItem)
        {
            $item = \App\Models\Item::query()->where('ListID', $cartItem->prod_id)->get()->first();
            $saleItem = new SalesOrderItem();
            $saleItem->sales_order_id = $sale->id;
            $saleItem->SalesOrderLineItemRefListID = $item->ListID;
            $saleItem->SalesOrderLineDesc = $item->Description;
            $saleItem->SalesOrderLineQuantity = $cartItem->qty;
            $saleItem->SalesOrderLineRate = $item->SalesPrice;
            $saleItem->SalesOrderLineRatePercent =null;
            $saleItem->SalesOrderLineAmount = $cartItem->qty * $item->SalesPrice;
            $saleItem->save();
        }
        CartItem::query()->where('uid', Auth::user()->id)->delete();
        SendFirstOrderMail::dispatch($this->customer_id);
        Import_Sales_Order_To_QB::dispatch($sale->id);
        return redirect()->to(route('dashboard') . '?order=' . $sale->id);
    }
}
