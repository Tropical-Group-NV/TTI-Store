<?php

namespace App\Jobs;

use App\Mail\registrationAdmin;
use App\Mail\registrationCustomer;
use App\Models\AdminEmail;
use App\Models\TemporaryUserInfo;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class CustomerRegistrationMailJob implements ShouldQueue
{
//    TODO Job for sending customer registration mail
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $customerID;
    public function __construct($id)
    {
        $this->customerID = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $admins = AdminEmail::all();
        $newUser = TemporaryUserInfo::query()->where('id', $this->customerID)->first();
        foreach ($admins as $admin)
        {
            Mail::to($admin->email)->send(new registrationAdmin($this->customerID));
        }
//        Mail::to($newUser->email)->send(new registrationCustomer($this->customerID));

    }
}
