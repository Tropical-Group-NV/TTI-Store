<?php

namespace App\Jobs;

use App\Mail\OrderNew;
use App\Models\ImportSoInProcess;
use App\Models\QbCustomer;
use App\Models\SalesOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use App\Http\Livewire\Orders;
use Illuminate\Support\Facades\Mail;

class Import_Sales_Order_To_QB implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $sales_order_id;
    private $currency;
    private $currencyRate;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($order_id, $curr, $cuRate)
    {
        $this->sales_order_id = $order_id;
        $this->currency = $curr;
        $this->currencyRate = $cuRate;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        if (ImportSoInProcess::query()->count() == 0)
        {
            $in_process = new ImportSoInProcess();
            $in_process->in_process = 1;
            $in_process->save();
            try
            {
                $model = SalesOrder::query()->where('id', $this->sales_order_id)->first();
                $c = QbCustomer::query()->where('ListID', $model->CustomerRefListID)->first();
                $logo = asset('tti-new_email');
                $qrLogo = asset('tti-email-qr');
                $currency = 'SRD';
                DB::connection('qb_sales')->update( "EXEC [dbo].[sp_insert_sales_order_to_quickbook] @sales_order_id = " . $this->sales_order_id. '; SET NOCOUNT ON;');
                if ($c->Email != '' or $c->Email != null)
                {
                    Mail::to($c->Email)->send(new OrderNew($this->sales_order_id, $this->currency, $this->currencyRate));
                }
                ImportSoInProcess::query()->delete();
            }
            catch (\Exception $e)
            {
                ImportSoInProcess::query()->delete();
            }


        }
        else
        {
            Import_Sales_Order_To_QB::dispatch($this->sales_order_id, $this->currency, $this->currencyRate)->delay(now()->addMinutes(5));
        }


    }
}
