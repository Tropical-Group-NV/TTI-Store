<?php

namespace App\Mail;

use App\Models\BackOrders;
use App\Models\Item;
use App\Models\QbCustomer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BackOrderInStock extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($boID)
    {
        $this->BackOrderID = $boID;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $model = BackOrders::query()->where('id', $this->BackOrderID)->first();
        $customer = QbCustomer::query()->where('ListID', $model->CustomerRefListID)->first();
        $item = Item::query()->where('ListID', $model->ListID)->first();
        return $this->view('emails.backorders.backorder-instock', compact('model', 'customer'))->subject($item->Description.' now available on TTIStore');
    }
}
