<?php

namespace App\Http\Livewire;

use App\Models\CartItem;
use App\Models\QbCustomer;
use App\Models\Quotation;
use App\Models\QuotationItem;
use App\Models\Term;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CreateQuotation extends Component
{

    public $QItems = [];
    public $saleCustomer;
    public $items = [];
    public $customers = [];
    public $customerSearch;
    public $selectedCustomer;
    public $selectedCustomerID;
    public $search;
    public $term_id;
    public $date;
    public $subTotal;
    public $poNum;
    public $signature;
    public $msg_id;
    public $memo;
    public $memoTemplate;
    public $customerError;
    public $termError;
    public $dateError;
    public $itemError;

    protected $rules = [
        'selectedCustomerID' => 'required',
        'term_id' => 'required',
        'date' => 'required',
        ];



//    public $

    public function mount()
    {
        $this->date = date('Y-m-d');

        if ( isset($_REQUEST['fromcart'])and $_REQUEST['fromcart'] != null)
        {
            $cartItems = CartItem::query()->where('uid', Auth::user()->id)->get();
            foreach ($cartItems as $cartItem)
            {
                $item = \App\Models\Item::query()->where('ListID', $cartItem->prod_id)->first(['SalesPrice', 'Description', 'FullName']);

                end($this->QItems);
                $lastKey = key($this->QItems);
                $newKey = $lastKey + 1;
                $this->QItems[$newKey]['itemID'] = $cartItem->prod_id;
                $this->QItems[$newKey]['rate'] = $item->SalesPrice;
                $this->QItems[$newKey]['description'] = $item->Description;
                $this->QItems[$newKey]['qty'] = $cartItem->qty;
            }
        }
        if (isset($_REQUEST['customer']) and $_REQUEST['customer'] != null)
        {
            $this->selectedCustomer = QbCustomer::query()->where('ListID', $_REQUEST['customer'])->first(['ListID', 'BillAddressAddr1', 'BillAddressAddr2', 'BillAddressAddr3', 'BillAddressAddr4', 'BillAddressAddr5', 'TermsRefListID']);
            $this->selectedCustomerID = $this->selectedCustomer->ListID;
            $this->term_id = $this->selectedCustomer->TermsRefListID;
            $this->customerSearch = $this->selectedCustomer->BillAddressAddr1;
        }
    }

    public function render()
    {
        return view('livewire.create-quotation');
    }

    public function searchItems()
    {
        $this->items = \App\Models\Item::query()->where('IsActive', '1')->where('description', 'LIKE', '%' . $this->search . '%')->where('Type', 'ItemInventory')->orWhere('FullName', 'LIKE', '%' . $this->search . '%')->where('IsActive', '1')->where('Type', 'ItemInventory')->orWhere('description', 'LIKE', '%' . $this->search . '%')->where('ListID', '520000-1128115782')->orWhere('description', 'LIKE', '%' . $this->search . '%')->where('ListID', '530000-1128435487')->orderBy('description', 'DESC')->limit(10)->get(['SalesPrice', 'Description', 'FullName', 'CustomFieldBranch', 'SalesDesc', 'ListID', 'ItemDesc']);
    }

    public function addItem($itemID)
    {
        if (in_array($itemID, $this->QItems))
        {
            if ($itemID == '520000-1128115782')
            {
                end($this->QItems);
                $lastKey = key($this->QItems);
                $newKey = $lastKey + 1;
                $this->QItems[$newKey]['itemID'] = $itemID;
                $this->QItems[$newKey]['rateType'] = 1;
                $this->QItems[$newKey]['rate'] = 0;
            }
            if ($itemID == '530000-1128435487')
            {
                end($this->QItems);
                $lastKey = key($this->QItems);
                $newKey = $lastKey + 1;
                $this->QItems[$newKey]['itemID'] = $itemID;
                $this->QItems[$newKey]['rate'] = $this->subTotal;
            }

        }
        else
        {
            if ($itemID == '520000-1128115782')
            {
                end($this->QItems);
                $lastKey = key($this->QItems);
                $newKey = $lastKey + 1;
                $this->QItems[$newKey]['itemID'] = $itemID;
                $this->QItems[$newKey]['rateType'] = 1;
                $this->QItems[$newKey]['rate'] = 0;
                $this->QItems[$newKey]['rateValue'] = 0;

            }
            if ($itemID == '530000-1128435487')
            {
                end($this->QItems);
                $lastKey = key($this->QItems);
                $newKey = $lastKey + 1;
                $this->QItems[$newKey]['itemID'] = $itemID;
                $this->QItems[$newKey]['rate'] = $this->subTotal;
                $this->QItems[$newKey]['rateValue'] = $this->subTotal;
            }
            if ($itemID != '530000-1128435487' and $itemID != '520000-1128115782' )
            {
                $item = \App\Models\Item::query()->where('ListID', $itemID)->first(['SalesPrice', 'Description', 'FullName']);

                end($this->QItems);
                $lastKey = key($this->QItems);
                $newKey = $lastKey + 1;
                $this->QItems[$newKey]['itemID'] = $itemID;
                $this->QItems[$newKey]['rate'] = $item->SalesPrice;
                $this->QItems[$newKey]['description'] = $item->Description;
                $this->QItems[$newKey]['qty'] = 1;
            }

        }
    }

    public function changeDiscountRateValue($key, $value)
    {
        $this->QItems[$key]['rateValue'] = $value;
    }

    public function changeQuantity($prodID, $qty)
    {
        $key = array_search($prodID, $this->QItems);
        if(is_int($qty) )
        {
            $this->QItems[$key]['qty'] = $qty;
        }

    }

    public function removeItem($key)
    {
        unset($this->QItems[$key]);
    }

    public function getCustomers()
    {
        if (Auth::user()->users_type_id == 2)
        {
            $salesRep = DB::connection('qb_sales')->table('users_salesRep')->where('user_id', Auth::user()->id)->first();
            $this->customers = DB::connection('epas')->table('QB_Customer')->where('ISActive', 1)->where('Name', 'LIKE', '%' . $this->customerSearch . '%')->where('SalesRepRefListID' , $salesRep->salesRep_ListID)->orderBy('Name', 'ASC')->limit(10)->get(['ListID', 'BillAddressAddr1', 'BillAddressAddr2', 'BillAddressAddr3', 'BillAddressAddr4', 'BillAddressAddr5', 'TermsRefListID']);
        }
        if (Auth::user()->users_type_id == 5 or Auth::user()->users_type_id == 1)
        {
            $this->customers = DB::connection('epas')->table('QB_Customer')->where('ISActive', 1)->where('Name', 'LIKE', '%' . $this->customerSearch . '%')->orderBy('Name', 'ASC')->limit(10)->get(['ListID', 'BillAddressAddr1', 'BillAddressAddr2', 'BillAddressAddr3', 'BillAddressAddr4', 'BillAddressAddr5', 'TermsRefListID']);
        }
    }

    public function selectCustomer($cID)
    {
//        $this->selectedCustomer = QbCustomer::query()->where('ListID', $cID)->first(['ListID', 'BillAddressAddr1', 'BillAddressAddr2', 'BillAddressAddr3', 'BillAddressAddr4', 'BillAddressAddr5', 'TermsRefListID']);
        $this->selectedCustomer = QbCustomer::query()->where('ListID', $cID)->first();
        $this->selectedCustomerID = $this->selectedCustomer->ListID;
        $this->term_id = $this->selectedCustomer->TermsRefListID;
        $this->customerSearch = $this->selectedCustomer->BillAddressAddr1;
    }

    public function changeDiscountType($key, $value)
    {
        $this->QItems[$key]['rateType'] = $value;
    }
    public function changeDiscountValue($key, $value)
    {
//        if (is_float($value))
//        {
        try
        {
            $answer = $value+1;
            $this->QItems[$key]['rate'] = $value;
//            $this->QItems[$key]['rateValue'] = $value;
            $this->QItems[$key]['type'] = gettype($value);

        }
        catch (\Exception $exception)
        {

        }

//        }
    }
    public function changeSubTotalRate($rate, $arrayKey)
    {
        $this->QItems[$arrayKey]['rate'] = $rate;
    }


//    Create quotation here.
    public function createQuotation()
    {
        $this->validate();
//        if (empty($this->QItems))
//        {
//            $this->itemError = 'Please select at least one item';
//            return false;
//        }
        $term = Term::query()->where('ListID', $this->term_id)->first();
        $quotation = new Quotation();
        $quotation->CustomerRefListID = $this->selectedCustomer->ListID;
        $quotation->TxnDate = $this->date;
        $quotation->BillAddressAddr1 = $this->selectedCustomer->BillAddressAddr1;
        $quotation->BillAddressAddr2 = $this->selectedCustomer->BillAddressAddr2;
        $quotation->BillAddressAddr3 = $this->selectedCustomer->BillAddressAddr3;
        $quotation->BillAddressAddr4 = $this->selectedCustomer->BillAddressAddr4;
        $quotation->BillAddressAddr5 = $this->selectedCustomer->BillAddressAddr5;
        $quotation->ShipAddressAddr1 = $this->selectedCustomer->BillAddressAddr1;
        $quotation->ShipAddressAddr2 = $this->selectedCustomer->BillAddressAddr2;
        $quotation->ShipAddressAddr3 = $this->selectedCustomer->BillAddressAddr3;
        $quotation->ShipAddressAddr4 = $this->selectedCustomer->BillAddressAddr4;
        $quotation->ShipAddressAddr5 = $this->selectedCustomer->BillAddressAddr5;
        $quotation->PONumber = $this->poNum;
        $quotation->Memo = $this->memo;
        $quotation->uid = Auth::user()->id;
        $quotation->TermsRefListID = $this->term_id;
        $quotation->TermsRefFullName = $term->Name;
        $quotation->ShipDate = $this->date;
        $quotation->is_so = 0;
        $quotation->signature_id = $this->signature;
        $quotation->save();
        Quotation::query()->where('id', $quotation->id)->update(['RefNumber' => 'Q-' . 10617 + $quotation->id]);



        foreach ($this->QItems as $key => $item)
        {
            $prod = \App\Models\Item::query()->where('ListID', $item['itemID'])->first();
            if ($item['itemID'] == '520000-1128115782')
            {
                if ($item['rateType'] == 2)
                {
                    $lastkey = $key -1;
                    $lastItemPrice = $this->QItems[$lastkey]['rate'];
                    $discount = $item['rate'] * ($lastItemPrice/100);
                    $quotationItem = new QuotationItem();
                    $quotationItem->quotation_id = $quotation->id;
                    $quotationItem->SalesOrderLineItemRefListID = $item['itemID'];
                    $quotationItem->SalesOrderLineDesc = $prod->Description;
                    $quotationItem->SalesOrderLineRatePercent = -$item['rate'];
                    $quotationItem->SalesOrderLineAmount = -$discount;
                    $quotationItem->save();
                }
                else
                {
                    $discount = $item['rate'];
                    $quotationItem = new QuotationItem();
                    $quotationItem->quotation_id = $quotation->id;
                    $quotationItem->SalesOrderLineItemRefListID = $item['itemID'];
                    $quotationItem->SalesOrderLineDesc = $item['description'];
                    $quotationItem->SalesOrderLineRate = -$item['rate'];
                    $quotationItem->SalesOrderLineAmount = -$discount;
                    $quotationItem->save();
                }

            }
            if ($item['itemID'] != '520000-1128115782' and $item['itemID'] != '530000-1128435487')
            {
                $quotationItem = new QuotationItem();
                $quotationItem->quotation_id = $quotation->id;
                $quotationItem->SalesOrderLineItemRefListID = $item['itemID'];
                $quotationItem->SalesOrderLineDesc = $item['description'];
                $quotationItem->SalesOrderLineQuantity = $item['qty'];
                $quotationItem->SalesOrderLineRate = $item['rate'];
                $quotationItem->SalesOrderLineAmount =$item['qty'] * $item['rate'];
                $quotationItem->save();
            }
        }

        return $this->redirect(route('quotations.index'));
    }
    public function setDefaultMemoTemplate()
    {
        if ($this->memoTemplate == 1)
        {
            $this->memo = 'Prijzen: af Tropical Trade & Industries N.V.
Levering: uit voorraad leverbaar
Betaling: binnen 30 (dertig) dagen middels overmaking
Geldigheid offerte: 3 (drie) dagen na dag tekening';
        }
        if ($this->memoTemplate == 2)
        {
            $this->memo = 'Prices ex-Warehouse Tropical Trade & Industries N.V.
Delivery: within 2 (two) weeks
Payment: 50% pre-payment 50% within 30 days
Quotation valid until:';
        }
        if ($this->memoTemplate == 0)
        {
            $this->memo = '';
        }
    }

}
