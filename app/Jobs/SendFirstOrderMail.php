<?php

namespace App\Jobs;

use App\Models\AuditMail;
use App\Models\QbCustomer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendFirstOrderMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $customerID;
    public $userID;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($cID, $uid)
    {
        $this->customerID = $cID;
        $this->userID = $uid;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $customer = QbCustomer::query()->where('ListID', $this->customerID)->first();
        if ($customer->Email != '' or $customer->Email != null)
        {
            try {
                $mail = Mail::raw('Bedankt voor uw bestelling. Uw bestelling wordt verwerkt.',
                    function($msg)
                    {
                        $customer = QbCustomer::query()->where('ListID', $this->customerID)->first();
                        $msg->to($customer->Email)->subject('Bestelling via T-Sales');
                    });
                $audit = new AuditMail();
                $audit->uid = $this->userID;
                $audit->emailTo = $customer->Email;
                $audit->status = 1;
                $audit->message = 'Bestelling via T-Sales van ' . $customer->Name;
                $audit->save();

            }

            catch (\Exception $e)
            {
                $audit = new AuditMail();
                $audit->uid = $this->userID;
                $audit->emailTo = $customer->Email;
                $audit->status = 0;
                $audit->error = $e;
                $audit->message = 'Bestelling via T-Sales van ' . $customer->Name;
                $audit->save();
            }
        }
    }
}
