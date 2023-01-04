<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Uni5PayTester extends Component
{
    private $response;
    public $test;
    public $paymentLink;

    public function mount()
    {

    }

    public function render()
    {
//        $this->response = Http::withHeaders([ 'ApiKey' => 'c23d0927-85d3-42ee-9f59-a665eb138649',
//            'public_key'=>'MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQC9wdg1X6/BzGnuAxDow7Cd2UoGXCvCHbJGzxaziM3ojxQt8uPcQ9Ql4gFPwSgEga7qxT+KMKzwSKxQff2ZjsgaMZdx3iT0ssFuwHGFpVOh1ny7p7ZU0LRQX+mZ8VGaI5w33Ldxgt/30fsGUwOUX8lR3m/YwymquHHYrxyEgfac9wIDAQAB'])->post('https://payment.uni5pay.sr/v1/qrcode_online',
//        [
//
//            'id' => 'eb4c9a0a-aac1-4562-8281-5f13fcb784c0',
//            'mchtOrderNo' => '27122204',
//                'payment_desc' => 'TEST1',
//                'amount' => '10.00',
//                'currency' => '968',
//                'terminalId' => 'TGN',
//                'url_success' => 'http://www.ttistore.com',
//                'url_failure' => 'http://www.ttistore.com',
//                'url_notify' => 'http://www.ttistore.com'
//        ]);
        return view('livewire.uni5-pay-tester', ['response' => $this->response]);
    }

    public function makePayment()
    {
      $this->response = Http::withHeaders([ 'ApiKey' => 'c23d0927-85d3-42ee-9f59-a665eb138649'])->post('https://payment.uni5pay.sr/v1/qrcode_online',
        [
            'id' => 'eb4c9a0a-aac1-4562-8281-5f13fcb784c0',
            'mchtOrderNo' => '27122205',
                'payment_desc' => 'TEST1',
                'amount' => '1.00',
                'currency' => '968',
                'terminalId' => 'TGN',
                'url_success' => 'https://dev.ttistore.com',
                'url_failure' => 'https://dev.ttistore.com',
                'url_notify' => 'https://dev.ttistore.com'
        ]);
      $responseArray = json_decode($this->response, true);
      $this->test = 'https://payment.uni5pay.sr/' . $responseArray['id'];
      $this->paymentLink = 'https://payment.uni5pay.sr/' . $responseArray['id'];
        return redirect($this->paymentLink);
    }

    public function pay()
    {
//        $responseArray = json_decode($this->response, true);
        return redirect($this->paymentLink);
    }
}
