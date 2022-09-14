<?php

namespace App\Mail;

use App\Models\TemporaryUserInfo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class registrationCustomer extends Mailable
{
    use Queueable, SerializesModels;

    public $userID;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->userID = $id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $cInfo = DB::table('temporary_user_infos')->where('id', $this->userID)->get()->first();
        return $this->view('emails.registration.registration-customer', ['request' => $cInfo])->subject('Uw TTISTore registratie gegevens.');
    }
}
