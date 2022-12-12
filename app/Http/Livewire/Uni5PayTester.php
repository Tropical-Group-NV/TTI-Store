<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Uni5PayTester extends Component
{
//    pri $response;

    public function render()
    {
        $response = Http::asForm()->post('https://payment.uni5pay.sr/v1/qrcode_get',
        [
            'ApiKey' => '7d1b52b5-9ae5-4339-a0de-f340c708e178',
            'mchtOrderNo' => '454510',
                'amount' => '10.00',
                'currency' => '968',
                'terminalId' => 'WEB',
                'url_success' => 'http://www.ttistore.com',
                'url_failure' => 'http://www.ttistore.com',
                'url_notify' => 'http://www.ttistore.com'
        ])->body();
//        $response-> = Http::;
//        $response->headers(['ApiKey' => 'c23d0927-85d3-42ee-9f59-a665eb138649']);
//        $response->body(array(
//                'mchtOrderNo' => '454510',
//                'amount' => '10.00',
//                'currency' => '968',
//                'terminalId' => 'WEB',
//                'url_success' => 'http://www.example.com',
//                'url_failure' => 'http://www.example.com',
//                'url_notify' => 'http://www.example.com'
//            ));
        return view('livewire.uni5-pay-tester', compact('response'));
    }

    public function makePayment()
    {
//        $this->response = Http::post('https://payment.uni5pay.sr/v1/qrcode_get');
//        $this->response->body(
//            array(
//                'mchtOrderNo' => '454510',
//                'amount' => '10.00',
//                'currency' => '968',
//                'terminalId' => 'WEB',
//                'url_success' => 'http://www.example.com',
//                'url_failure' => 'http://www.example.com',
//                'url_notify' => 'http://www.example.com'
//            )
//        );
    }
}
