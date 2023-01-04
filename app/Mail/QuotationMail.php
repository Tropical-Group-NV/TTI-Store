<?php

namespace App\Mail;

use App\Models\Quotation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QuotationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $from2;
    public $to2;
    public $cc2;
    public $subject2;
    public $description2;
    public $qId2;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($from, $to, $cc, $subject, $description, $qId)
    {
        $this->from2 = $from;
        $this->to2 = $to;
        $this->cc2 = $cc;
        $this->subject2 = $subject;
        $this->description2 = $description;
        $this->qId2 = $qId;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $quotation = Quotation::query()->where('id', $this->qId2)->first();
        $model = Quotation::query()->where('id', $this->qId2)->first();
        $desc = $this->description2;
        $logo = public_path('tti-new_email.jpg');
        $qrLogo = public_path('tti-email-qr.png');
//        $message = $this;

        return $this->view('emails.quotations.quotation', compact('quotation', 'model', 'desc', 'logo', 'qrLogo'))->subject($this->subject2)->replyTo($this->from2);
    }
}
