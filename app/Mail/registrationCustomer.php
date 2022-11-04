<?php

namespace App\Mail;

use App\Models\LoginToken;
use App\Models\TemporaryUserInfo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class registrationCustomer extends Mailable
{
//    TODO Customer mail for customer registration
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
        $loginToken = LoginToken::query()->where('uid', $cInfo->uid)->first();
        return $this->view('emails.registration.registration-customer', ['request' => $cInfo, 'token' => $loginToken])->subject('Dankuwel voor het registreren bij TTISTORE');
    }
}
