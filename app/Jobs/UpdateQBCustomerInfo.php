<?php

namespace App\Jobs;

use App\Models\QbCustomer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class UpdateQBCustomerInfo implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $customerListID;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($cID)
    {
        $this->customerListID = $cID;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $customer = QbCustomer::query()->where('ListID', $this->customerListID)->first();
        if ($customer->CompanyName == '')
        {
            DB::connection('qb_sales')->update(
//                "UPDATE QREMOTE...customer set FirstName = '" .  $customer->FirstName . "', LastName = '$customer->LastName', FullName = '$customer->FirstName $customer->LastName', BillAddressAddr1 = '$customer->FirstName $customer->LastName', BillAddressAddr2 = '$customer->BillAddressAddr2'
//                , BillAddressAddr4 = '$customer->BillAddressBlockAddr4', BillAddressBlockAddr1 = '$customer->FirstName $customer->LastName', BillAddressBlockAddr2 = 'customer->BillAddressAddr2', BillAddressBlockAddr4 = '$customer->BillAddressBlockAddr4',ShipAddressAddr1 = '$customer->FirstName $customer->LastName', ShipAddressAddr2 = '$customer->BillAddressAddr2', ShipAddressAddr4 = '$customer->BillAddressBlockAddr4',ShipAddressBlockAddr1 = '$customer->FirstName $customer->LastName', ShipAddressBlockAddr2 = '$customer->BillAddressAddr2', ShipAddressBlockAddr4 = '$customer->BillAddressBlockAddr4' where ListID = '" . $this->customerListID . "'"
                "UPDATE QREMOTE...customer set FirstName = '" .  $customer->FirstName . "', LastName = '$customer->LastName', Name = '$customer->FirstName $customer->LastName', BillAddressAddr1 = '$customer->FirstName $customer->LastName', BillAddressAddr2 = '$customer->BillAddressAddr2'
                , BillAddressAddr4 = '$customer->BillAddressBlockAddr4',ShipAddressAddr1 = '$customer->FirstName $customer->LastName', ShipAddressAddr2 = '$customer->BillAddressAddr2', ShipAddressAddr4 = '$customer->BillAddressBlockAddr4', Phone = '$customer->Phone', PriceLevelRefListID = '$customer->PriceLevelRefListID', PriceLevelRefFullName = '$customer->PriceLevelRefFullName'  where ListID = '" . $this->customerListID . "'"
//                LastName' => $customer->LastName,
//                'FullName' => $customer->FirstName . ' ' . $customer->LastName,
//                'Name' => $customer->FirstName . ' ' . $customer->LastName,
//                'BillAddressAddr1' => $customer->FirstName . ' ' . $customer->LastName,
//                'BillAddressAddr2' => $customer->BillAddressAddr2,
//                'BillAddressAddr4' => $customer->BillAddressBlockAddr4,
//                'BillAddressBlockAddr1' => $customer->FirstName . ' ' . $customer->LastName,
//                'BillAddressBlockAddr2' => $customer->BillAddressAddr2,
//                'BillAddressBlockAddr4' => $customer->BillAddressBlockAddr4,
//                'ShipAddressAddr1' => $customer->FirstName . ' ' . $customer->LastName,
//                'ShipAddressAddr2' => $customer->BillAddressAddr2,
//                'ShipAddressAddr4' => $customer->BillAddressBlockAddr4,
//                'ShipAddressBlockAddr1' => $customer->FirstName . ' ' . $customer->LastName,
//                'ShipAddressBlockAddr2' => $customer->BillAddressAddr2,
//                'ShipAddressBlockAddr4' => $customer->BillAddressBlockAddr4
            );
        }
        else
        {
            DB::connection('qb_sales')->update(

//                "UPDATE QREMOTE...customer set FirstName = '" .  $customer->FirstName . "', LastName = '$customer->LastName', FullName = '$customer->FirstName $customer->LastName', BillAddressAddr1 = '$customer->FirstName $customer->LastName', BillAddressAddr2 = '$customer->BillAddressAddr2'
//                , BillAddressAddr4 = '$customer->BillAddressBlockAddr4', BillAddressBlockAddr1 = '$customer->FirstName $customer->LastName', BillAddressBlockAddr2 = 'customer->BillAddressAddr2', BillAddressBlockAddr4 = '$customer->BillAddressBlockAddr4',ShipAddressAddr1 = '$customer->FirstName $customer->LastName', ShipAddressAddr2 = '$customer->BillAddressAddr2', ShipAddressAddr4 = '$customer->BillAddressBlockAddr4',ShipAddressBlockAddr1 = '$customer->FirstName $customer->LastName', ShipAddressBlockAddr2 = '$customer->BillAddressAddr2', ShipAddressBlockAddr4 = '$customer->BillAddressBlockAddr4' where ListID = '" . $this->customerListID . "'"
                "UPDATE QREMOTE...customer set FirstName = '" .  $customer->FirstName . "', LastName = '$customer->LastName', Name = '$customer->CompanyName', CompanyName = '$customer->companyName', BillAddressAddr1 = '$customer->FirstName $customer->LastName', BillAddressAddr2 = '$customer->BillAddressAddr2'
                , BillAddressAddr4 = '$customer->BillAddressBlockAddr4',ShipAddressAddr1 = '$customer->FirstName $customer->LastName', ShipAddressAddr2 = '$customer->BillAddressAddr2', ShipAddressAddr4 = '$customer->BillAddressBlockAddr4', Phone = '$customer->Phone', PriceLevelRefListID = '$customer->PriceLevelRefListID', PriceLevelRefFullName = '$customer->PriceLevelRefFullName'  where ListID = '" . $this->customerListID . "'"
//                LastName' => $customer->LastName,
//                'FullName' => $customer->FirstName . ' ' . $customer->LastName,
//                'Name' => $customer->FirstName . ' ' . $customer->LastName,
//                'BillAddressAddr1' => $customer->FirstName . ' ' . $customer->LastName,
//                'BillAddressAddr2' => $customer->BillAddressAddr2,
//                'BillAddressAddr4' => $customer->BillAddressBlockAddr4,
//                'BillAddressBlockAddr1' => $customer->FirstName . ' ' . $customer->LastName,
//                'BillAddressBlockAddr2' => $customer->BillAddressAddr2,
//                'BillAddressBlockAddr4' => $customer->BillAddressBlockAddr4,
//                'ShipAddressAddr1' => $customer->FirstName . ' ' . $customer->LastName,
//                'ShipAddressAddr2' => $customer->BillAddressAddr2,
//                'ShipAddressAddr4' => $customer->BillAddressBlockAddr4,
//                'ShipAddressBlockAddr1' => $customer->FirstName . ' ' . $customer->LastName,
//                'ShipAddressBlockAddr2' => $customer->BillAddressAddr2,
//                'ShipAddressBlockAddr4' => $customer->BillAddressBlockAddr4

            );
        }

    }
}
