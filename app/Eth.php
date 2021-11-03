<?php

namespace App;

use Response;
use App\Wallet;
use App\Transaction as SaveTransaction;

use Web3\Web3;
use Web3\Utils;
use Web3\Contract;
use Web3\Providers\HttpProvider;
use Web3\RequestManagers\HttpRequestManager;
use Web3p\EthereumTx\Transaction;

use Ixudra\Curl\Facades\Curl;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class Eth {

    private $contractAddr = '0x1c8cf5f43768ce4dfb1110674a91990cbbb6d21d';
    private $ets_key='F7SK7HDAMT12K6VGGGKHEZXSF6AUPPBPB6';
	private $ifr_secret='08aa378006f34457aedb69e9bde7e493';
	private $ifr_url='https://mainnet.infura.io/v3/08aa378006f34457aedb69e9bde7e493';

	public function __construct() {
        $this->web3 = new Web3(new HttpProvider(new HttpRequestManager($this->ifr_url, 10)));
        $this->eth = $this->web3->eth;
        $this->gasPrice = $this->transactionGas();
        $this->chainId = 1;
    }

    public function qrCode($address)
    {
        $renderer = new \BaconQrCode\Renderer\Image\Png();
        $renderer->setWidth(300);
        $renderer->setHeight(300);
        $encoding = 'utf-8';
        $bacon = new \BaconQrCode\Writer($renderer);
        $data = $bacon->writeString($address, $encoding);
        $qrCode = 'data:image/png;base64,'.base64_encode($data);
        return $qrCode;
    }

    public function transaction($hash){
        $this->eth->getTransactionReceipt($hash, function ($err, $data) {
            if ($err !== null) {
                $this->transactionData = [];
                return;
            }
            $this->transactionData = $data;
        });
        return $this->transactionData;
    }

    public function balance($fromAddress){
        $this->eth->getBalance($fromAddress, function ($err, $balance) {
            if ($err !== null) {
                $this->balanceData = -1;
                return;
            }
            $this->balanceData = $balance->toString();
        });
        if($this->balanceData == -1){
            return false;
        }
        return $this->balanceData;
    }

    public function balanceErc($fromAddress){
        $abiArray = json_decode(file_get_contents(base_path('abi.json')), true);
        $this->contract = new Contract($this->web3->provider, $abiArray);

        $this->contract->at($this->contractAddr)->call('balanceOf', $fromAddress, function ($err, $balance) {
            if ($err !== null) {
                $this->balanceErcData = -1;
                return;
            }
            $this->balanceErcData = $balance[0]->toString();
        });
        if($this->balanceErcData == -1){
            return false;
        }
        return $this->balanceErcData;
    }

    public function nonce($fromAddress){
        $this->eth->getTransactionCount($fromAddress, 'pending', function ($err, $nonce) {
            if ($err !== null) {
                $this->noncedata = -1;
                return;
            }
            $this->noncedata = $nonce->toString();
        });
        if($this->noncedata == -1){
            return false;
        }
        return $this->noncedata;
    }

    public function estimateEth($fromAddress, $toAddress, $value){
        if($this->balance($fromAddress) == -1){
            return false;
        }
        $gas = "21000";
        $chainId = $this->chainId;
        $gasPrice = $this->gasPrice;
        $balance = $this->balanceData;
        $gasValue = $gas * $gasPrice;
        $estimatedValue = $balance - $gasValue;
        // $gasLimit = $this->estimateGas($toAddress,$value);

        if($value == "all"){
            $valueToSend = strval($estimatedValue);
            $estimatedToSend = $estimatedValue;
        }else{
            // $valueToSend = $this->toWei($value);
            $valueToSend = Utils::toWei("{$value}", "ether")->toString();
            $estimatedToSend = $estimatedValue - $valueToSend;
        }
        $fee = $this->toEth($gasValue, 18);
        $coin = $this->toEth($valueToSend, 18);
        if($estimatedToSend > 0){
            return compact('fromAddress','toAddress','chainId','gas','gasPrice','valueToSend','coin','fee');
        }
        return false;
    }

    public function estimateGas($to_addr,$amount)
    {
        $gasLimit = 0;
        $abiArray = json_decode(file_get_contents(base_path('abi.json')), true);
        $contract = new Contract($this->web3->provider, $abiArray);
        $contract->at($this->contractAddr)->estimateGas('transfer', $to_addr, $amount, function ($err, $gas) use ($gasLimit) {
            if ($err !== null) {
                echo $err->getMessage();
                return false;
            } else {
                $gasLimit = $gas;
            }
        });
        return $gasLimit;
    }

    public function toWei($value)
    {
    	$bn = new \Moontoast\Math\BigNumber($value,17); //Adds 17 decimal places
		$bn->multiply(1000000000000000000); //multiplies out by 1.0 E+18
		$bn2 = new \Moontoast\Math\BigNumber($bn->getValue(),0); //Chops off the remainder
		$wei = $bn2->getValue();
		return $wei;
    }

    public function wei2eth($wei)
    {
        return bcdiv($wei,'1000000000000000000',18);
    }

    public function cryptoNumberFormat($value, $decimal){
	    $dividend = (string)$value;
	    $divisor = (string)'1'. str_repeat('0', $decimal);
	    return bcdiv($value, $divisor, $decimal);
	}

    public function estimateErc20($fromAddress, $toAddress, $value){
    	$decimals = 18;
        if($this->balanceErc($fromAddress, $this->contractAddr) == -1){
            return false;
        }
        $balance = $this->balanceErcData;
        if($balance == 0){
            return false;
        }
        $val = 0;
        $gas = "60000";
        $chainId = $this->chainId;
        $gasPrice = $this->gasPrice;
        $balanceErc = $this->toEth($balance,$decimals);
        $tokenDecimals = '1e'.$decimals;
        if($value == "all"){
            $balanceErcHex =  $this->decHex($tokenDecimals * $balanceErc);
            $coin = $balanceErc;
        }else{
            $balanceErcHex =  $this->decHex($tokenDecimals * $value);
            $coin = $value;
        }
        $data = '0x' . $this->contract->at($this->contractAddr)->getData('transfer', $toAddress, $balanceErcHex);
        $contractAddr = $this->contractAddr;
        return compact('fromAddress','contractAddr','val','chainId','gas','gasPrice','data','balanceErc', 'coin');
    }

    protected function send($trx, $data, $id, $key, $nonce, $type){
        // dd($trx, $data, $id, $key, $nonce, $type);
        $transaction = new Transaction($trx);
        $serializedTx = $transaction->sign($key);
        $this->eth->sendRawTransaction('0x'.$serializedTx, function ($err, $tx) {
            if ($err !== null) {
                echo $err->getMessage();
                $this->tx = -1;
                return;
            }
            $this->tx = $tx;
        });

        // if($this->tx != -1 && $type == "send"){
        //     SaveTransaction::where('code',$id)->update(['trx_id' => $this->tx,'status'=>1]);
        // }

        $res = array('success'=>false);
        if($this->tx != -1){
            $res = array('success'=>true, 'hash'=>$this->tx);
        }
        return $res;
    }

    public function sendEth($data, $id, $key, $nonce, $type){
        $trx = [
            'nonce' => sprintf($this->decHex($nonce)),
            'from' => $data['fromAddress'],
            'to' => $data['toAddress'],
            'value' => $this->decHex($data['valueToSend']),
            'gas' => $this->decHex($data['gas']),
            'gasPrice' => $this->decHex($data['gasPrice']),
            'chainId' => $data['chainId']
        ];
        return $this->send($trx, $data, $id, $key, $nonce, $type);
    }

    public function sendErc($data, $id, $key, $nonce, $type){
        $trx = [
            'nonce' => sprintf($this->decHex($nonce)),
            'from' => $data['fromAddress'],
            'to' => $data['contractAddr'],
            'value' => $this->decHex($data['val']),
            'gas' => $this->decHex($data['gas']),
            'gasPrice' => $this->decHex($data['gasPrice']),
            'chainId' => $data['chainId'],
            'data' => $data['data']
        ];
        return $this->send($trx, $data, $id, $key, $nonce, $type);
    }

    public function toEth($val, $des) {
        $v = (string)$val;
        $data = $v / pow(10, $des);
        return $data;
    }

    public function decHex($val) {
        $data= (int)$val;
        return '0x'.dechex($data);
    }

    public function decodeHexStatus($input)
    {
        if (substr($input, 0, 2) == '0x') {
            $input = substr($input, 2);
        }

        if (preg_match('/[a-f0-9]+/', $input)) {
            $decData = hexdec($input);
            if($decData == 0){
                $send = "failed";
            }else{
                $send = "success";
            }
            return $send;
        }
        return $input;
    }

    public function decodeHex($input)
    {
        if (substr($input, 0, 2) == '0x') {
            $input = substr($input, 2);
        }

        if (preg_match('/[a-f0-9]+/', $input)) {
            $decData = hexdec($input);
            return $decData;
        }
        return $input;
    }

    public function addrValid($val) {
        $data = Utils::isAddress($val);
        return $data;
    }

    public function transactionGas()
    {
    	$url = "https://api.etherscan.io/api?module=gastracker&action=gasoracle&apikey=F7SK7HDAMT12K6VGGGKHEZXSF6AUPPBPB6";
        $response = Curl::to($url)->asJson()->get();
    	// $gas = $response->result->SafeGasPrice.'000000000';
    	$gas = $response->result->ProposeGasPrice.'000000000';
    	// $gas = $response->result->FastGasPrice.'000000000';
        return $gas;
    }

    public function transactionEth($addr)
    {
        $url = 'https://api.etherscan.io/api?module=account&action=txlist&address='.$addr.'&page=1&offset=latest&sort=desc&apikey=F7SK7HDAMT12K6VGGGKHEZXSF6AUPPBPB6';
        $response = Curl::to($url)->asJson()->get();
        return $response;
    }

    public function transactionErc20($addr)
    {
        $url = 'https://api.etherscan.io/api?module=account&action=tokentx&contractaddress='.$this->contractAddr.'&address='.$addr.'&page=1&offset=latest&sort=desc&apikey=F7SK7HDAMT12K6VGGGKHEZXSF6AUPPBPB6';
        $response = Curl::to($url)->asJson()->get();
        return $response;
    }

    public function checkBalanceEth($addr){
        $url = 'https://api.etherscan.io/api?module=account&action=balance&address='.$addr.'&tag=latest&apikey=F7SK7HDAMT12K6VGGGKHEZXSF6AUPPBPB6';
        $response = Curl::to($url)->asJson()->get();
        return $response;
    }

    public function checkBalanceErc20($addr) {
        $url = 'https://api.etherscan.io/api?module=account&action=tokenbalance&contractaddress='.$this->contractAddr.'&address='.$addr.'&tag=latest&apikey=F7SK7HDAMT12K6VGGGKHEZXSF6AUPPBPB6';
        $response = Curl::to($url)->asJson()->get();
        return $response;
    }
}
