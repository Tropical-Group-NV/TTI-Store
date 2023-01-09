<?php

namespace App\Mail;

use App\Models\QbCustomer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CrmMail extends Mailable
{
    use Queueable, SerializesModels;

    public $s;
    public $mess;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $message)
    {
        $this->s = $subject;
        $this->mess = $message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mess = $this->mess;
        return $this->view('emails.crm.crm', compact('mess'))->subject($this->s);
    }
}
