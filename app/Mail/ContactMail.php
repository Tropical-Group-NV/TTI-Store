<?php

namespace App\Mail;

use App\Models\Message;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $messageID;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mID)
    {
        $this->messageID = $mID;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mesg = Message::query()->where('id', $this->messageID)->first();
        return $this->view('emails.contact.new-message', compact('mesg'))->subject('Nieuw bericht van ttistore.com');

    }
}
