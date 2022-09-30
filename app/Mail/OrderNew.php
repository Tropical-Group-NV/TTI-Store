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
    public $currency;
    public $currencyRate;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($soID, $curr, $cuRate)
    {
        $this->SalesOrderID = $soID;
        $this->currency = $curr;
        $this->currencyRate = $cuRate;
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
        $currency = $this->currency;
        $rate = $this->currencyRate;
        return $this->view('emails.orders.ordernew', compact('model', 'customer', 'logo', 'qrLogo', 'currency', 'rate'))->subject('Uw bestelling via TTIStore - S.O. '. $model->RefNumber);
    }
}
