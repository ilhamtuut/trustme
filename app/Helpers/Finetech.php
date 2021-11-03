<?php

namespace App\Helpers;

use Response;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class Finetech {

    private $symbol = 'dc';
    private $link = 'https://finetech.live/api/v1/currencys/';
    private $api_token = '8QJrK0nZb7edzC5jF0Kwektq5g0lvWUSbuDBKvBEqa2PuDFRWXPZaylEgMX8obq6eI';

    public function checkAddress($address)
    {
        $response = Curl::to($this->link.'address')
	        ->withData([
                'simbol' => $this->symbol,
	            'address' => $address
	        ])
	        ->asJson()
	        ->get();
	    return $response;
    }

    public function send($from,$to,$value)
    {
        $response = Curl::to($this->link.'send')
	        ->withData([
                'token' => $this->api_token,
                'simbol' => $this->symbol,
	            'from' => $from,
	            'to' => $to,
	            'value' => $value
	        ])
	        ->asJson()
	        ->post();
	    return $response;
    }
}
