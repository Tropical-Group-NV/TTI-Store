<?php

namespace App\Http\Livewire;

use App\Jobs\Import_Sales_Order_To_QB;
use App\Jobs\SendFirstOrderMail;
use App\Models\BackOrders;
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
    public $term_id = 'E0000-1129212579';
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

        if (isset($_REQUEST['customerid']))
        {
            $customer = Customer::query()->where('ListID', $_REQUEST['customerid'])->get()->first();
            $this->customer_id = $_REQUEST['customerid'];
            $this->search_customer = $customer->Name;
        }
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
        $product = \App\Models\Item::query()->where('ListID', $item->prod_id)->first();
        $item->qty = $qty;
        $item->save();

        if ($qty > $product->QuantityOnHand)
        {
            $this->dispatchBrowserEvent('updateCartQty', ['prodID' => $id, 'Qty' => number_format($qty) , 'inStock' =>  number_format($product->QuantityOnHand), 'BO' => $qty-$product->QuantityOnHand, 'addBO' => 1]);
        }
        else
        {
            $this->dispatchBrowserEvent('updateCartQty', ['prodID' => $id, 'Qty' => number_format($qty) , 'inStock' =>  number_format($product->QuantityOnHand) , 'addBO' => 0]);

        }

    }

    public function clearCart()
    {
        $item = CartItem::query()->where('uid', Auth::user()->id)->delete();
        $this->emit('updateCart');

    }

    public function search()
    {
            $this->search_sw = 1;
            if (Auth::user()->users_type_id == 2)
            {
                $salesRep = DB::connection('qb_sales')->table('users_salesRep')->where('user_id', Auth::user()->id)->first();
                $this->customers = DB::connection('epas')->table('QB_Customer')->where('ISActive', 1)->where('Name', 'LIKE', '%' . $this->search_customer . '%')->where('SalesRepRefListID' , $salesRep->salesRep_ListID)->orderBy('Name', 'ASC')->limit(10)->get();
            }
            if (Auth::user()->users_type_id == 5 or Auth::user()->users_type_id == 1)
            {
                $this->customers = DB::connection('epas')->table('QB_Customer')->where('ISActive', 1)->where('Name', 'LIKE', '%' . $this->search_customer . '%')->orderBy('Name', 'ASC')->limit(10)->get();
            }
    }

    public function createSalesOrder(Request $request)
    {

        if (Auth::user()->users_type_id != 3)
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
                $item = \App\Models\Item::query()->where('ListID', $cartItem->prod_id)->first();
                if($cartItem->qty > $item->QuantityOnHand)
                {
                    $saleItem = new SalesOrderItem();
                    $saleItem->sales_order_id = $sale->id;
                    $saleItem->SalesOrderLineItemRefListID = $item->ListID;
                    $saleItem->SalesOrderLineDesc = $item->Description;
                    $saleItem->SalesOrderLineQuantity = $item->QuantityOnHand;
                    $saleItem->SalesOrderLineRate = $item->SalesPrice;
                    $saleItem->SalesOrderLineRatePercent =null;
                    $saleItem->SalesOrderLineAmount = $item->QuantityOnHand * $item->SalesPrice;
                    $saleItem->save();

                    $bo = new BackOrders();
                    $bo->CustomerRefListID = $customer->ListID;
                    $bo->ListID = $item->ListID;
                    $bo->OrderQuantity = $item->QuantityOnHand;
                    $bo->BackOrderQuantity = $cartItem->qty - $item->QuantityOnHand;
                    $bo->uid = Auth::user()->id;
                    $bo->email = $customer->Email;
                    $bo->mail_is_send = null;
                    $bo->mail_send_date_time = null;
                    $bo->QuantityOnHandOnCreated = $item->QuantityOnHand;
                    $bo->QuantityOnHandOnMailSend = null;
                    $bo->first_mail_is_send = null;
                    $bo->save();

                    $saveItem = \App\Models\Item::query()->where('ListID', $item->ListID)->first();
                    $saveItem->QuantityOnHand = '0';
                    $saveItem->save();

//                    \App\Models\Item::query()->where('ListID', $cartItem->prod_id)->update(['QuantityOnHand' => 0 ]);
                }
                else
                {
                    $saleItem = new SalesOrderItem();
                    $saleItem->sales_order_id = $sale->id;
                    $saleItem->SalesOrderLineItemRefListID = $item->ListID;
                    $saleItem->SalesOrderLineDesc = $item->Description;
                    $saleItem->SalesOrderLineQuantity = $cartItem->qty;
                    $saleItem->SalesOrderLineRate = $item->SalesPrice;
                    $saleItem->SalesOrderLineRatePercent =null;
                    $saleItem->SalesOrderLineAmount = $cartItem->qty * $item->SalesPrice;
                    $saleItem->save();

                    $saveItem = \App\Models\Item::query()->where('ListID', $item->ListID)->first();
                    $saveItem->QuantityOnHand = $item->QuantityOnHand - $cartItem->qty;
                    $saveItem->save();
//                    \App\Models\Item::query()->where('ListID', $cartItem->prod_id)->update(['QuantityOnHand' => $item->QuantityOnHand - $cartItem->qty  ]);
                }
            }
            CartItem::query()->where('uid', Auth::user()->id)->delete();
            SendFirstOrderMail::dispatch($this->customer_id);
            Import_Sales_Order_To_QB::dispatch($sale->id);
            return redirect()->to(route('dashboard') . '?order=' . $sale->id);
        }
        else
        {
            $customerAccount = \Illuminate\Support\Facades\DB::connection('qb_sales')->table('users_customer')->where('user_id', \Illuminate\Support\Facades\Auth::user()->id)->first();
            $cartItems = CartItem::query()->where('uid', Auth::user()->id)->get();
            $customer = DB::connection('epas')->table('QB_Customer')->where('ListID', $customerAccount->customer_ListID)->first();
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
                if($cartItem->qty > $item->QuantityOnHand)
                {
                    $saleItem = new SalesOrderItem();
                    $saleItem->sales_order_id = $sale->id;
                    $saleItem->SalesOrderLineItemRefListID = $item->ListID;
                    $saleItem->SalesOrderLineDesc = $item->Description;
                    $saleItem->SalesOrderLineQuantity = $item->QuantityOnHand;
                    $saleItem->SalesOrderLineRate = $item->SalesPrice;
                    $saleItem->SalesOrderLineRatePercent =null;
                    $saleItem->SalesOrderLineAmount = $item->QuantityOnHand * $item->SalesPrice;
                    $saleItem->save();

                    $bo = new BackOrders();
                    $bo->CustomerRefListID = $customer->ListID;
                    $bo->ListID = $item->ListID;
                    $bo->OrderQuantity = $item->QuantityOnHand;
                    $bo->BackOrderQuantity = $cartItem->qty - $item->QuantityOnHand;
                    $bo->uid = Auth::user()->id;
                    $bo->email = $customer->Email;
                    $bo->mail_is_send = null;
                    $bo->mail_send_date_time = null;
                    $bo->QuantityOnHandOnCreated = $item->QuantityOnHand;
                    $bo->QuantityOnHandOnMailSend = null;
                    $bo->first_mail_is_send = null;
                    $bo->save();
                    $saveItem = \App\Models\Item::query()->where('ListID', $item->ListID)->first();
                    $saveItem->QuantityOnHand = '0';
                    $saveItem->save();
                }
                if($cartItem->qty <= $item->QuantityOnHand)
                {
                    $saleItem = new SalesOrderItem();
                    $saleItem->sales_order_id = $sale->id;
                    $saleItem->SalesOrderLineItemRefListID = $item->ListID;
                    $saleItem->SalesOrderLineDesc = $item->Description;
                    $saleItem->SalesOrderLineQuantity = $cartItem->qty;
                    $saleItem->SalesOrderLineRate = $item->SalesPrice;
                    $saleItem->SalesOrderLineRate = $item->SalesPrice;
                    $saleItem->SalesOrderLineRatePercent =null;
                    $saleItem->SalesOrderLineAmount = $cartItem->qty * $item->SalesPrice;
                    $saleItem->save();
                    $saveItem = \App\Models\Item::query()->where('ListID', $item->ListID)->first();
                    $saveItem->QuantityOnHand = $item->QuantityOnHand - $cartItem->qty;
                    $saveItem->save();
                }
            }
            CartItem::query()->where('uid', Auth::user()->id)->delete();
            SendFirstOrderMail::dispatch($customerAccount->customer_ListID);
            Import_Sales_Order_To_QB::dispatch($sale->id);
            return redirect()->to(route('dashboard') . '?order=' . $sale->id);
        }
    }
}
