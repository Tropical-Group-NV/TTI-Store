<?php

namespace App\Http\Livewire;

use App\Mail\ContactMail;
use App\Mail\registrationAdmin;
use App\Models\AdminEmail;
use App\Models\Message;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class ContactPage extends Component
{
    public $name;
    public $subject;
    public $message;
    public $phone;
    public $email;
    public $contactError;
    public $last_name;

    public function render()
    {
        return view('livewire.contact-page');
    }

    protected $rules =
        [
            'name' => 'required',
            'message' => 'required'
        ];

    public function sendMessage()
    {
        if ($this->phone == '' and $this->email == '')
        {
            $this->contactError = 'Please provide an email or phone number we can contact you on.';
            $this->validate();
        }
        else
        {
                if (!session()->has('messagesSent') or session()->has('messagesSent') and session()->get('messagesSent') < 2)
                {
                $this->contactError = '';
                $this->validate();
                $message = new Message();
                $message->name = $this->name;
                if ($this->subject = '')
                {
                    $message->subject = '';
                }
                else
                {
                    $message->subject = $this->subject;
                }
                $message->message = $this->message;
                $message->phone = $this->phone;
                $message->email = $this->email;
                $message->save();
                if (session()->has('messagesSent'))
                {
                    if (is_array(session()->get('messagesSent')))
                    {
                        session()->remove('messagesSent');
                        session()->put('messagesSent', 1);
                    }
                    else
                    {
                        $messagesSent = session()->get('messagesSent') + 1;
                        session()->put('messagesSent', $messagesSent);
                    }

                }
                else
                {
                    session()->put('messagesSent', 1);
                }
                $admins = AdminEmail::all();
                foreach ($admins as $admin)
                {
                    Mail::to($admin->email)->send(new ContactMail($message->id));
//                    Mail::to($admin->email)->send(new registrationAdmin($this->customerID));
                }
                $this->name = '';
                $this->subject= '';
                $this->message = '';
                $this->phone = '';
                $this->email = '';
                $this->dispatchBrowserEvent('messageSent', ['message' => 'Added to cart']);
            }


        }

    }
}
