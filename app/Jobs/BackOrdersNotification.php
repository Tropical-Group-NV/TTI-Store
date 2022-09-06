<?php

namespace App\Jobs;

use App\Mail\BackOrderInStock;
use App\Mail\BackOrdersFirst;
use App\Models\BackOrders;
use App\Models\Item;
use App\Models\QbCustomer;
use App\Models\SalesOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class BackOrdersNotification implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $BackOrdersFirstMails = BackOrders::query()->where('first_mail_is_send', '0')->get();
        foreach ($BackOrdersFirstMails as $backOrdersFirstMail)
        {
            $model = BackOrders::query()->where('id', $backOrdersFirstMail->id)->first();
            $c = QbCustomer::query()->where('ListID', $model->CustomerRefListID)->first();
            Mail::to('jamil.kasan@tropicalgroupnv.com')->send(new BackOrdersFirst($backOrdersFirstMail->id));
            BackOrders::query()->where('id', $backOrdersFirstMail->id)->update(['first_mail_is_send' => '1'] );
        }

        $BackOrdersInStock = BackOrders::query()->where('mail_is_send', '0')->get();
        foreach ($BackOrdersInStock as $backOrdersFirstMail)
        {
            $item = Item::query()->where('ListID', $backOrdersFirstMail->ListID)->first();
            if ($item->QuantityOnHand > $backOrdersFirstMail->BackOrderQuantity)
            {
                $model = BackOrders::query()->where('id', $backOrdersFirstMail->id)->first();
                $c = QbCustomer::query()->where('ListID', $model->CustomerRefListID)->first();
                Mail::to('jamil.kasan@tropicalgroupnv.com')->send(new BackOrderInStock($backOrdersFirstMail->id));
                BackOrders::query()->where('id', $backOrdersFirstMail->id)->update(['mail_is_send' => '1', 'mail_send_date_time' => date('Y/m/d H:i:s'), 'QuantityOnHandOnMailSend' => $item->QuantityOnHand] );
            }
        }
    }
}
