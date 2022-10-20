<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class registrationAdmin extends Mailable
{
    use Queueable, SerializesModels;

//    TODO admin mail for customer registration

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $userID;


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
        return $this->view('emails.registration.registration-admin', ['request' => $cInfo])->subject('Nieuwe TTIStore registratie');
    }
}
