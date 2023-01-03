<?php

namespace App\Http\Livewire;

use App\Jobs\Import_Sales_Order_To_QB;
use App\Jobs\SendFirstOrderMail;
use App\Models\BackOrders;
use App\Models\CartItem;
use App\Models\CustomerMessage;
use App\Models\QbCustomer;
use App\Models\SalesOrderItem;
use App\Models\TempBoItem;
use App\Models\TempSO;
use App\Models\TempSoItem;
use App\Models\UserCustomer;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\SalesOrder;
use App\Models\Term;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
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
    public $saleCustomer;
    public $search_customer;
    public $search_sw;
    public $terms;
    public $status_msg;
    public $ship1;
    public $ship2;
    public $ship3;
    public $ship4;
    public $ship5;
    public $retail;

    public function boot()
    {
        if ($this->customer_id != '')
        {
            $this->saleCustomer = QbCustomer::query()->where('ListID', $this->customer_id)->first();
        }
        if (Auth::user()->user_type_id == 3)
        {
            $customerAccount = \Illuminate\Support\Facades\DB::connection('qb_sales')->table('users_customer')->where('user_id', \Illuminate\Support\Facades\Auth::user()->id)->first();
            $cartItems = CartItem::query()->where('uid', Auth::user()->id)->get();
            $customer = DB::connection('epas')->table('QB_Customer')->where('ListID', $customerAccount->customer_ListID)->first();
            $this->customer_id = $customerAccount->customer_ListID;
        }
    }
    public function mount()
    {
        if (Auth::user()->users_type_id == 3)
        {
            $usercustomer = UserCustomer::query()->where('user_id', Auth::user()->id)->first();
            $customeraccount = QbCustomer::where('ListID', $usercustomer->customer_ListID)->first();
            if ($customeraccount->PriceLevelRefFullName == 'Retail')
            {
                $this->retail = 1;
            }
        }




        $this->date= date('Y-m-d');

        if (isset($_REQUEST['customerid']))
        {
            $customer = Customer::query()->where('ListID', $_REQUEST['customerid'])->get()->first();
            $this->customer_id = $_REQUEST['customerid'];
            $this->search_customer = $customer->Name;
            $this->ship1 = $customer->ShipAddressBlockAddr1 . ',' . $customer->ShipAddressBlockAddr2 . ',' . $customer->ShipAddressBlockAddr3 . ',' . $customer->ShipAddressBlockAddr4 . ',' . $customer->ShipAddressBlockAddr5;
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


//    TODO change Cart Item qty
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

        if ($qty > 0 and !is_int($qty))
        {
            $item = CartItem::query()->where('id', $id)->first();
            $product = \App\Models\Item::query()->where('ListID', $item->prod_id)->first();
            $item->qty = $qty;
            $item->save();

            if ($qty > $product->QuantityOnHand - $product->QuantityOnSalesOrder)
            {
                $this->dispatchBrowserEvent('updateCartQty', ['prodID' => $id, 'Qty' => number_format($qty) , 'inStock' =>  number_format($product->QuantityOnHand - $product->QuantityOnSalesOrder), 'BO' => $qty-($product->QuantityOnHand - $product->QuantityOnSalesOrder), 'addBO' => 1]);
            }
            else
            {
                $this->dispatchBrowserEvent('updateCartQty', ['prodID' => $id, 'Qty' => number_format($qty) , 'inStock' =>  number_format($product->QuantityOnHand - $product->QuantityOnSalesOrder) , 'addBO' => 0]);

            }
        }
    }

    public function clearCart()
    {
        $item = CartItem::query()->where('uid', Auth::user()->id)->delete();
        $this->emit('updateCart');

    }

    public function search()
    {
//        TODO search customers
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

    public function addCustomer($cID)
    {
        $this->saleCustomer = QbCustomer::where('ListID',$cID)->first();
    }

    public function selectPayment($paymentId)
    {
        $this->paymentMethod = $paymentId;
    }

    public function pay()
    {
        if ($this->paymentMethod == 1)
        {
            $this->Uni5PayPayment();
        }
        if ($this->paymentMethod == 2)
        {
            $this->createSalesOrder(null);
        }
    }

    public function createSalesOrder(Request $request)
    {

//        TODO Create SalesOrder

        if (Auth::user()->users_type_id != 3)
        {
            $cartItems = CartItem::query()->where('uid', Auth::user()->id)->get();
            $customer = DB::connection('epas')->table('QB_Customer')->where('ListID', $this->customer_id)->first();
            $shipping_array = explode(',', $this->ship1);
            if ($this->msg_id != '')
            {
                $cst_msg = CustomerMessage::query()->where('ListID', $this->msg_id)->get()->first();
            }
            $term = Term::query()->where('ListID', $this->term_id)->get()->first();
            $sale = new SalesOrder();
            $sale->CustomerRefListID = $customer->ListID;
            $sale->TxnDate = $this->date;
            $sale->BillAddressAddr1 = $customer->BillAddressBlockAddr1;
            $sale->BillAddressAddr2 = $customer->BillAddressBlockAddr2;
            $sale->BillAddressAddr3 = $customer->BillAddressBlockAddr3;
            $sale->BillAddressAddr4 = $customer->BillAddressBlockAddr4;
            $sale->BillAddressAddr5 = $customer->BillAddressBlockAddr5;
            if ($this->customer_id == '410000-1128694047' )
            {
                $sale->ShipAddressAddr1 = $shipping_array[0] ?? null;
                $sale->ShipAddressAddr2 = $shipping_array[1] ?? null;
                $sale->ShipAddressAddr3 = $shipping_array[2] ?? null;
                $sale->ShipAddressAddr4 = $shipping_array[3] ?? null;
                $sale->ShipAddressAddr5 = $shipping_array[4] ?? null;
            }
            else
            {
                $sale->ShipAddressAddr1 = $customer->BillAddressBlockAddr1;
                $sale->ShipAddressAddr2 = $customer->BillAddressBlockAddr2;
                $sale->ShipAddressAddr3 = $customer->BillAddressBlockAddr3;
                $sale->ShipAddressAddr4 = $customer->BillAddressBlockAddr4;
                $sale->ShipAddressAddr5 = $customer->BillAddressBlockAddr5;
            }


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
                if($cartItem->qty > $item->QuantityOnHand - $item->QuantityOnSalesOrder)
                {
                    if ($this->customer_id == '410000-1128694047' or $this->retail == 1)
                    {
                        $saleItem = new SalesOrderItem();
                        $saleItem->sales_order_id = $sale->id;
                        $saleItem->SalesOrderLineItemRefListID = $item->ListID;
                        $saleItem->SalesOrderLineDesc = $item->Description;
                        $saleItem->SalesOrderLineQuantity = ($item->QuantityOnHand - $item->QuantityOnSalesOrder);
                        $saleItem->SalesOrderLineRate = $item->CustomBaliPrice;
                        $saleItem->SalesOrderLineRatePercent =null;
                        $saleItem->SalesOrderLineAmount = ($item->QuantityOnHand - $item->QuantityOnSalesOrder) * $item->CustomBaliPrice;
                        $saleItem->save();
                    }
                    else
                    {
                        $saleItem = new SalesOrderItem();
                        $saleItem->sales_order_id = $sale->id;
                        $saleItem->SalesOrderLineItemRefListID = $item->ListID;
                        $saleItem->SalesOrderLineDesc = $item->Description;
                        $saleItem->SalesOrderLineQuantity = $item->QuantityOnHand - $item->QuantityOnSalesOrder;
                        $saleItem->SalesOrderLineRate = $item->SalesPrice;
                        $saleItem->SalesOrderLineRatePercent =null;
                        $saleItem->SalesOrderLineAmount = ($item->QuantityOnHand - $item->QuantityOnSalesOrder) * $item->SalesPrice;
                        $saleItem->save();
                    }


                    $bo = new BackOrders();
                    $bo->CustomerRefListID = $customer->ListID;
                    $bo->ListID = $item->ListID;
                    $bo->OrderQuantity = $item->QuantityOnHand - $item->QuantityOnSalesOrder;
                    $bo->BackOrderQuantity = $cartItem->qty - ($item->QuantityOnHand - $item->QuantityOnSalesOrder);
                    $bo->uid = Auth::user()->id;
                    $bo->email = $customer->Email;
                    $bo->mail_is_send = null;
                    $bo->mail_send_date_time = null;
                    $bo->QuantityOnHandOnCreated = $item->QuantityOnHand;
                    $bo->QuantityOnHandOnMailSend = null;
                    $bo->first_mail_is_send = null;
                    $bo->save();

                    $saveItem = \App\Models\Item::query()->where('ListID', $item->ListID)->first();
                    $saveItem->QuantityOnSalesOrder = $saveItem->QuantityOnSalesOrder + ($item->QuantityOnHand - $item->QuantityOnSalesOrder);
                    $saveItem->save();

//                    \App\Models\Item::query()->where('ListID', $cartItem->prod_id)->update(['QuantityOnHand' => 0 ]);
                }
                else
                {
                    if ($this->customer_id == '410000-1128694047' or $this->retail == 1)
                    {
                        $saleItem = new SalesOrderItem();
                        $saleItem->sales_order_id = $sale->id;
                        $saleItem->SalesOrderLineItemRefListID = $item->ListID;
                        $saleItem->SalesOrderLineDesc = $item->Description;
                        $saleItem->SalesOrderLineQuantity = $cartItem->qty;
                        $saleItem->SalesOrderLineRate = $item->CustomBaliPrice;
                        $saleItem->SalesOrderLineRatePercent =null;
                        $saleItem->SalesOrderLineAmount = $cartItem->qty * $item->CustomBaliPrice;
                        $saleItem->save();
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
                    }


                    $saveItem = \App\Models\Item::query()->where('ListID', $item->ListID)->first();
                    $saveItem->QuantityOnSalesOrder = $saveItem->QuantityOnSalesOrder + $cartItem->qty;
                    $saveItem->save();
//                    \App\Models\Item::query()->where('ListID', $cartItem->prod_id)->update(['QuantityOnHand' => $item->QuantityOnHand - $cartItem->qty  ]);
                }
            }
            foreach ($cartItems as $cartItem)
            {
                CartItem::find($cartItem->id)->delete();
            }
            SendFirstOrderMail::dispatch($this->customer_id, Auth::user()->id);
            if (session()->has('currency'))
            {
                Import_Sales_Order_To_QB::dispatch($sale->id, session()->get('currency'), session()->get('exchangeRate'));
            }
            else
            {
                Import_Sales_Order_To_QB::dispatch($sale->id, 'SRD', 1);
            }
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
            if ($this->customer_id == '410000-1128694047' )
            {
                $sale->ShipAddressAddr1 = $shipping_array[0] ?? null;
                $sale->ShipAddressAddr2 = $shipping_array[1] ?? null;
                $sale->ShipAddressAddr3 = $shipping_array[2] ?? null;
                $sale->ShipAddressAddr4 = $shipping_array[3] ?? null;
                $sale->ShipAddressAddr5 = $shipping_array[4] ?? null;
            }
            else
            {
                $sale->ShipAddressAddr1 = $customer->BillAddressBlockAddr1;
                $sale->ShipAddressAddr2 = $customer->BillAddressBlockAddr2;
                $sale->ShipAddressAddr3 = $customer->BillAddressBlockAddr3;
                $sale->ShipAddressAddr4 = $customer->BillAddressBlockAddr4;
                $sale->ShipAddressAddr5 = $customer->BillAddressBlockAddr5;
            }
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
                if($cartItem->qty > ($item->QuantityOnHand - $item->QuantityOnSalesOrder))
                {
                    if ($this->customer_id == '410000-1128694047' or $this->retail == 1)
                    {
                        $saleItem = new SalesOrderItem();
                        $saleItem->sales_order_id = $sale->id;
                        $saleItem->SalesOrderLineItemRefListID = $item->ListID;
                        $saleItem->SalesOrderLineDesc = $item->Description;
                        $saleItem->SalesOrderLineQuantity = ($item->QuantityOnHand - $item->QuantityOnSalesOrder);
                        $saleItem->SalesOrderLineRate = $item->CustomBaliPrice;
                        $saleItem->SalesOrderLineRatePercent =null;
                        $saleItem->SalesOrderLineAmount = ($item->QuantityOnHand - $item->QuantityOnSalesOrder) * $item->CustomBaliPrice;
                        $saleItem->save();
                    }
                    else
                    {
                        $saleItem = new SalesOrderItem();
                        $saleItem->sales_order_id = $sale->id;
                        $saleItem->SalesOrderLineItemRefListID = $item->ListID;
                        $saleItem->SalesOrderLineDesc = $item->Description;
                        $saleItem->SalesOrderLineQuantity = ($item->QuantityOnHand - $item->QuantityOnSalesOrder);
                        $saleItem->SalesOrderLineRate = $item->SalesPrice;
                        $saleItem->SalesOrderLineRatePercent =null;
                        $saleItem->SalesOrderLineAmount = ($item->QuantityOnHand - $item->QuantityOnSalesOrder) * $item->SalesPrice;
                        $saleItem->save();
                    }


                    $bo = new BackOrders();
                    $bo->CustomerRefListID = $customer->ListID;
                    $bo->ListID = $item->ListID;
                    $bo->OrderQuantity = ($item->QuantityOnHand - $item->QuantityOnSalesOrder);
                    $bo->BackOrderQuantity = $cartItem->qty - ($item->QuantityOnHand - $item->QuantityOnSalesOrder);
                    $bo->uid = Auth::user()->id;
                    $bo->email = $customer->Email;
                    $bo->mail_is_send = null;
                    $bo->mail_send_date_time = null;
                    $bo->QuantityOnHandOnCreated = $item->QuantityOnHand;
                    $bo->QuantityOnHandOnMailSend = null;
                    $bo->first_mail_is_send = null;
                    $bo->save();
                    $saveItem = \App\Models\Item::query()->where('ListID', $item->ListID)->first();
                    $saveItem->QuantityOnSalesOrder = $saveItem->QuantityOnSalesOrder + ($item->QuantityOnHand - $item->QuantityOnSalesOrder);
                    $saveItem->save();
                }
                if($cartItem->qty <= ($item->QuantityOnHand - $item->QuantityOnSalesOrder))
                {
                    if ($this->customer_id == '410000-1128694047' or $this->retail == 1)
                    {
                        $saleItem = new SalesOrderItem();
                        $saleItem->sales_order_id = $sale->id;
                        $saleItem->SalesOrderLineItemRefListID = $item->ListID;
                        $saleItem->SalesOrderLineDesc = $item->Description;
                        $saleItem->SalesOrderLineQuantity = $cartItem->qty;
                        $saleItem->SalesOrderLineRate = $item->CustomBaliPrice;
                        $saleItem->SalesOrderLineRatePercent = null;
                        $saleItem->SalesOrderLineAmount = $cartItem->qty * $item->CustomBaliPrice;
                        $saleItem->save();
                    }
                    else
                    {
                        $saleItem = new SalesOrderItem();
                        $saleItem->sales_order_id = $sale->id;
                        $saleItem->SalesOrderLineItemRefListID = $item->ListID;
                        $saleItem->SalesOrderLineDesc = $item->Description;
                        $saleItem->SalesOrderLineQuantity = $cartItem->qty;
                        $saleItem->SalesOrderLineRate = $item->SalesPrice;
                        $saleItem->SalesOrderLineRatePercent = null;
                        $saleItem->SalesOrderLineAmount = $cartItem->qty * $item->SalesPrice;
                        $saleItem->save();
                    }

                    $saveItem = \App\Models\Item::query()->where('ListID', $item->ListID)->first();
                    $saveItem->QuantityOnSalesOrder = $saveItem->QuantityOnSalesOrder + $cartItem->qty;
                    $saveItem->save();
                }
            }

            foreach ($cartItems as $cartItem)
            {
                CartItem::find($cartItem->id)->delete();
            }
            SendFirstOrderMail::dispatch($customerAccount->customer_ListID, Auth::user()->id);
            if (session()->has('currency'))
            {
                Import_Sales_Order_To_QB::dispatch($sale->id, session()->get('currency'), session()->get('exchangeRate'));
            }
            else
            {
                Import_Sales_Order_To_QB::dispatch($sale->id, 'SRD', 1);
            }
            return redirect()->to(route('dashboard') . '?order=' . $sale->id);
        }
    }

    public function Uni5PayPayment()
    {
        $cartItems = CartItem::query()->where('uid', Auth::user()->id)->get();
//        $sale = new TempSO();
//        $sale->customerListID = $this->customer_id;
//        $sale->userID = Auth::user()->id;
//        if ($this->memo != null)
//        {
//            $sale->memo = '1';
//        }
//        else
//        {
//            $sale->memo = '1';
//        }
//        $sale->date = date('Y-m-d');
//        $sale->save();
        $totalAmount = 0;

        foreach ($cartItems as $cartItem)
        {
            $item = \App\Models\Item::query()->where('ListID', $cartItem->prod_id)->get()->first();
//            if($cartItem->qty > ($item->QuantityOnHand - $item->QuantityOnSalesOrder))
//            {
//                if ($this->customer_id == '410000-1128694047' or $this->retail == 1)
//                {
//                    $saleItem = new TempSoItem();
//                    $saleItem->tempSoID = 1;
//                    $saleItem->prodID = $item->ListID;
//                    $saleItem->qty = ($item->QuantityOnHand - $item->QuantityOnSalesOrder);
//                    $saleItem->rate = $item->CustomBaliPrice;
//                    $saleItem->amount = ($item->QuantityOnHand - $item->QuantityOnSalesOrder) * $item->CustomBaliPrice;
//                    $saleItem->save();
//                }
//                else
//                {
//                    $saleItem = new TempSoItem();
//                    $saleItem->tempSoID = 1;
//                    $saleItem->prodID = $item->ListID;
//                    $saleItem->qty = ($item->QuantityOnHand - $item->QuantityOnSalesOrder);
//                    $saleItem->rate = $item->SalesPrice;
//                    $saleItem->amount = ($item->QuantityOnHand - $item->QuantityOnSalesOrder) * $item->SalesPrice;
//                    $saleItem->save();
//                }
//
//
//                $bo = new TempBoItem();
//                $bo->tempSoID = 1;
//                $bo->prodID = $item->ListID;
//                $bo->qty = $cartItem->qty - ($item->QuantityOnHand - $item->QuantityOnSalesOrder);
//                $bo->save();
//                $saveItem = \App\Models\Item::query()->where('ListID', $item->ListID)->first();
//                $saveItem->QuantityOnSalesOrder = $saveItem->QuantityOnSalesOrder + ($item->QuantityOnHand - $item->QuantityOnSalesOrder);
//                $saveItem->save();
//            }
            if($cartItem->qty <= ($item->QuantityOnHand - $item->QuantityOnSalesOrder))
            {
                if ($this->customer_id == '410000-1128694047' or $this->retail == 1)
                {
//                    $saleItem = new TempSoItem();
//                    $saleItem->tempSoID =1;
//                    $saleItem->prodID = $item->ListID;
//                    $saleItem->qty = $cartItem->qty;
//                    $saleItem->rate = $item->CustomBaliPrice;
//                    $saleItem->amount = $cartItem->qty * $item->CustomBaliPrice;
//                    $saleItem->save();
                }
                else
                {
//                    $saleItem = new TempSoItem();
//                    $saleItem->tempSoID = 1;
//                    $saleItem->prodID = $item->ListID;
//                    $saleItem->qty = $cartItem->qty;
//                    $saleItem->rate = $item->SalesPrice;
//                    $saleItem->amount = $cartItem->qty * $item->SalesPrice;
//                    $saleItem->save();

//                    $saleItem = DB::table('temp_so_item')->insert(['tempSoID' => 1, 'prodID' => 50, 'qty' => 50, 'rate' => 50, 'amount' => $cartItem->qty * $item->SalesPrice]);
                }

                $totalAmount = $totalAmount +  $cartItem->qty * $item->SalesPrice;
                $saveItem = \App\Models\Item::query()->where('ListID', $item->ListID)->first();
                $saveItem->QuantityOnSalesOrder = $saveItem->QuantityOnSalesOrder + $cartItem->qty;
                $saveItem->save();
            }

        }
        $response = Http::withHeaders([ 'ApiKey' => 'c23d0927-85d3-42ee-9f59-a665eb138649'])->post('https://payment.uni5pay.sr/v1/qrcode_online',
            [
                'mchtOrderNo' => '271222',
                'payment_desc' => $this->customer_id . '-' . date('dmYHis'),
                'amount' => number_format($totalAmount, 2),
                'currency' => '968',
                'terminalId' => 'TGN',
                'url_success' => 'https://dev.ttistore.com',
                'url_failure' => 'https://dev.ttistore.com',
                'url_notify' => 'https://dev.ttistore.com'
            ]);
        $responseArray = json_decode($response, true);
        $paymentLink = 'https://payment.uni5pay.sr/' . $responseArray['id'];
        return redirect($paymentLink);

    }
}
