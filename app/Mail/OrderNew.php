<?php

namespace App\Mail;

use App\Models\QbCustomer;
use App\Models\SalesOrder;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderNew extends Mailable
{
    use Queueable, SerializesModels;
    public $SalesOrderID;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($soID)
    {
        $this->SalesOrderID = $soID;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $model = SalesOrder::query()->where('id', $this->SalesOrderID)->first();
        $customer = QbCustomer::query()->where('ListID', $model->CustomerRefListID)->first();
        $logo = public_path('tti-new_email.jpg');
        $qrLogo = public_path('tti-email-qr.png');
        $currency = 'SRD';
        return $this->view('emails.orders.ordernew', compact('model', 'customer', 'logo', 'qrLogo', 'currency'))->subject('Uw bestelling via TTIStore - S.O. '. $model->RefNumber);
    }
}
