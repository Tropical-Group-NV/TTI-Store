<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use App\Http\Livewire\Orders;

class Import_Sales_Order_To_QB implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $sales_order_id;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($order_id)
    {
        DB::connection('qb_sales')->select( "EXEC [dbo].[sp_insert_sales_order_to_quickbook] @sales_order_id = " . $order_id);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

    }
}
