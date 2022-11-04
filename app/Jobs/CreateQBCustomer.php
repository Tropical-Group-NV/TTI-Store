<?php

namespace App\Jobs;

use App\Mail\registrationCustomer;
use App\Models\ImportSoInProcess;
use App\Models\LoginToken;
use App\Models\QbCustomer;
use App\Models\TemporaryUserInfo;
use App\Models\UserCustomer;
use http\Client\Curl\User;
use http\QueryString;
use Illuminate\Auth\Events\Login;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class CreateQBCustomer implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $uid;
    public $corporate;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($user_info, $corporate)
    {
        $this->uid = $user_info;
        $this->corporate = $corporate;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if (ImportSoInProcess::exists())
        {
            ImportSoInProcess::delete();
        }
        $uInfo = TemporaryUserInfo::query()->where('id', $this->uid)->first();
        if ($this->corporate != 1)
        {
            $Customer = DB::connection('qb_sales')->select( "EXEC [dbo].[sp_create_new_customer_jk] @name = '" . $uInfo->firstname . " " . $uInfo->name. "' ,@Firstname = '" . $uInfo->firstname . "',@Lastname = '" . $uInfo->name . "',@CompanyName = '" . $uInfo->company_name . "' ,@BillAddressAddr1 = '" . $uInfo->firstname . " " . $uInfo->name . "' ,@BillAddressAddr2 = '" . $uInfo->address . "' ,@BillAddressAddr3 = '' ,@BillAddressAddr4 = '" . $uInfo->country . "' ,@BillAddressAddr5 = '' ,@ShipAddressAddr1 ='"  . $uInfo->firstname . " " . $uInfo->name . "' ,@ShipAddressAddr2 = '" . $uInfo->address . "',@ShipAddressAddr3 = '' ,@ShipAddressAddr4 = '" . $uInfo->country . "' ,@ShipAddressAddr5 = '' ,@Phone = '" . $uInfo->phone . "',@Email = '" . $uInfo->email . "'" );
        }
        else
        {
            $Customer = DB::connection('qb_sales')->select( "EXEC [dbo].[sp_create_new_customer_jk] @name = '" . $uInfo->company_name . " " . $uInfo->name. "' ,@Firstname = '" . $uInfo->firstname . "',@Lastname = '" . $uInfo->name . "',@CompanyName = '" . $uInfo->company_name . "' ,@BillAddressAddr1 = '" . $uInfo->company_name . "' ,@BillAddressAddr2 = '" . $uInfo->address . "' ,@BillAddressAddr3 = '' ,@BillAddressAddr4 = '" . $uInfo->country . "' ,@BillAddressAddr5 = '' ,@ShipAddressAddr1 ='"  . $uInfo->company_name . "' ,@ShipAddressAddr2 = '" . $uInfo->address . "',@ShipAddressAddr3 = '' ,@ShipAddressAddr4 = '" . $uInfo->country . "' ,@ShipAddressAddr5 = '' ,@Phone = '" . $uInfo->phone . "',@Email = '" . $uInfo->email . "'" );
        }
        $result = json_decode(json_encode($Customer), true);
        $userCustomer = new UserCustomer();
        $userCustomer->user_id = $uInfo->uid;
        $userCustomer->customer_ListID = $result[0]['RESULT'];
        $userCustomer->save();
        if ($this->corporate != 1)
        {
            $customer = QbCustomer::where('ListID', $result[0]['RESULT'])->update(['PriceLevelRefListID' => '80000009-1583774102', 'PriceLevelRefFullName' => 'Retail']);
            UpdateQBCustomerInfo::dispatch($result[0]['RESULT']);
        }
        Mail::to($uInfo->email)->send(new registrationCustomer($this->uid));
        var_dump($Customer);
        $userCustomer->save();
//        TemporaryUserInfo::query()->where('id', $this->uid)->update(['company_name' => var_dump($Customer)]);
        $user = \App\Models\User::query()->where('id', $uInfo->uid)->update(['users_type_id' => '3']);
        $logintoken = LoginToken::query()->where('uid', $uInfo->uid)->first();

//        try
//        {
//            Http::get('http://192.168.1.206/cgi/WebCGI?1500101=account=smsapi&password=P@ssw0rd&port=3&destination=8744174&content=https://ttistore-front/login-token/73bdea03384ec67bf3ba75e5ff308e3f');
//        }
//        catch(\Exception $e)
//        {
//                        return $request->phone_code . $request->{$field['name']};
//        }
    }
}
