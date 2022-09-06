<?php

namespace App\Mail;

use App\Models\BackOrders;
use App\Models\QbCustomer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BackOrdersFirst extends Mailable
{
    use Queueable, SerializesModels;
    public $BackOrderID;

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
        return $this->view('emails.backorders.backorder-first', compact('model', 'customer'))->subject('New backorder on TTIStore');
    }
}
