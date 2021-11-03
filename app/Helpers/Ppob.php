<?php

namespace App\Helpers;

use Response;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class Ppob {

    private $nameApp = 'mydinasti';
    private $api_token = 'dfgdfgdfhtes';
    private $link = 'https://loki.harmonyb12.com/api_ppob/index.php/ptiga/controller_data/';
    private $link_trans = 'https://loki.harmonyb12.com/api_ppob/index.php/ptiga/controller_transaksi/';
    private $link_check = 'http://loki.harmonyb12.com/api_ppob/index.php/ptiga/controller_generate/';

    public function __construct()
    {
        if(env("APP_ENV") == 'production') {
            $this->nameApp = 'topupcling';
            $this->api_token = '123kjdghkgei4378';
            $this->link = 'http://103.226.51.74/index.php/ptiga/controller_data/';
            $this->link_trans = 'http://103.226.51.74/index.php/ptiga/controller_transaksi/';
            $this->link_check = 'http://103.226.51.74/index.php/ptiga/controller_generate/';
        }
    }

    public function pulsa($phone_number)
    {
        $response = Curl::to($this->link.'view_pulsa')
	        ->withData([
                'key' => $this->api_token,
                'nama' => $this->nameApp,
	            'nohp' => $phone_number
	        ])
	        ->withHeader('Content-Type: application/x-www-form-urlencoded')
	        ->post();
	    $res = json_decode($response);
	    return $res;
    }

    public function pln_prabayar()
    {
        $response = Curl::to($this->link.'paket_prabayar')
	        ->withData([
                'key' => $this->api_token,
                'nama' => $this->nameApp
	        ])
	        ->withHeader('Content-Type: application/x-www-form-urlencoded')
	        ->post();
	    $res = json_decode($response);
	    return $res;
    }

    public function voucher_game()
    {
        $response = Curl::to($this->link.'view_voucher_game')
	        ->withData([
                'key' => $this->api_token,
                'nama' => $this->nameApp,
                'jenis' => ''
	        ])
	        ->withHeader('Content-Type: application/x-www-form-urlencoded')
	        ->post();
	    $res = json_decode($response);
	    return $res;
    }

    public function paket_voucher($jenis)
    {
    	// jenis online atau offline
        $response = Curl::to($this->link.'paket_voucher')
	        ->withData([
                'key' => $this->api_token,
                'nama' => $this->nameApp,
                'jenis' => $jenis
	        ])
	        ->withHeader('Content-Type: application/x-www-form-urlencoded')
	        ->post();
	    $res = json_decode($response);
	    return $res;
    }

    public function paket_cc()
    {
        $response = Curl::to($this->link.'paket_cc')
	        ->withData([
                'key' => $this->api_token,
                'nama' => $this->nameApp
	        ])
	        ->withHeader('Content-Type: application/x-www-form-urlencoded')
	        ->post();
	    $res = json_decode($response);
	    return $res;
    }

    public function topup($jenis)
    {
    	// jenis = GOJEK atau GRAB / EMONEY / SHOPEE
        $response = Curl::to($this->link.'topup')
	        ->withData([
                'key' => $this->api_token,
                'nama' => $this->nameApp,
                'jenis' => $jenis
	        ])
	        ->withHeader('Content-Type: application/x-www-form-urlencoded')
	        ->post();
	    $res = json_decode($response);
	    return $res;
    }

    public function view_ppob($jenis)
    {
    	// jenis 1 = Angsuran,2 = PDAM,3 = Asuransi,4 = TV Kabel ,5 = PLN pascabayar,6 = Telkom Pascabayar
        $response = Curl::to($this->link.'view_ppob')
	        ->withData([
                'key' => $this->api_token,
                'nama' => $this->nameApp,
                'jenis' => $jenis
	        ])
	        ->withHeader('Content-Type: application/x-www-form-urlencoded')
	        ->post();
	    $res = json_decode($response);
	    return $res;
    }

    public function bayar_pulsa($idcustomer,$id_paket,$nominal)
    {
        // idcustomer = nomer telepon
        $response = Curl::to($this->link_trans.'buy_pulsa')
            ->withData([
                'key' => $this->api_token,
                'nama' => $this->nameApp,
                'idcustomer' => $idcustomer,
                'id_paket' => $id_paket,
                'nominal' => $nominal
            ])
            ->withHeader('Content-Type: application/x-www-form-urlencoded')
            ->post();
        $res = json_decode($response);
        return $res;
    }

    public function ppob_cek($idcustomer,$id_paket)
    {
        $response = Curl::to($this->link_trans.'ppob_cek')
	        ->withData([
                'key' => $this->api_token,
                'nama' => $this->nameApp,
                'idcustomer' => $idcustomer,
                'id_paket' => $id_paket
	        ])
	        ->withHeader('Content-Type: application/x-www-form-urlencoded')
	        ->post();
	    $res = json_decode($response);
	    return $res;
    }

    public function bayar_ppob($idcustomer,$id_paket,$nominal,$trxid_api)
    {
        $response = Curl::to($this->link_trans.'ppob_bayar')
	        ->withData([
                'key' => $this->api_token,
                'nama' => $this->nameApp,
                'idcustomer' => $idcustomer,
                'id_paket' => $id_paket,
                'nominal' => $nominal,
                'trxid_api' => $trxid_api
	        ])
	        ->withHeader('Content-Type: application/x-www-form-urlencoded')
	        ->post();
	    $res = json_decode($response);
	    return $res;
    }

    public function bayar_voucher($id_paket)
    {
        $response = Curl::to($this->link_trans.'buy_voucher')
	        ->withData([
                'key' => $this->api_token,
                'nama' => $this->nameApp,
                'id_paket' => $id_paket
	        ])
	        ->withHeader('Content-Type: application/x-www-form-urlencoded')
	        ->post();
	    $res = json_decode($response);
	    return $res;
    }

    public function bayar_cc($id_paket,$idpel,$nominal)
    {
        $response = Curl::to($this->link_trans.'bayar_cc')
	        ->withData([
                'key' => $this->api_token,
                'nama' => $this->nameApp,
                'id_paket' => $id_paket,
                'idpel' => $idpel,
                'nominal' => $nominal
	        ])
	        ->withHeader('Content-Type: application/x-www-form-urlencoded')
	        ->post();
	    $res = json_decode($response);
	    return $res;
    }

    public function bayar_topup($id_paket,$idpel)
    {
        $response = Curl::to($this->link_trans.'buy_topup')
	        ->withData([
                'key' => $this->api_token,
                'nama' => $this->nameApp,
                'id_paket' => $id_paket,
                'idpel' => $idpel
	        ])
	        ->withHeader('Content-Type: application/x-www-form-urlencoded')
	        ->post();
	    $res = json_decode($response);
	    return $res;
    }

    public function input_voucher($id_paket,$tgl_aktifasi,$tgl_kadaluarsa,$kode)
    {
        $response = Curl::to($this->link.'input_kode')
            ->withData([
                'key' => $this->api_token,
                'nama' => $this->nameApp,
                'id_paket' => $id_paket,
                'tgl_aktifasi' => $tgl_aktifasi,
                'tgl_kadaluarsa' => $tgl_kadaluarsa,
                'kode' => $kode
            ])
            ->withHeader('Content-Type: application/x-www-form-urlencoded')
            ->post();
        $res = json_decode($response);
        return $res;
    }

    public function view_voucher($id_paket)
    {
        $response = Curl::to($this->link.'view_kode')
            ->withData([
                'key' => $this->api_token,
                'nama' => $this->nameApp,
                'id_paket' => $id_paket
            ])
            ->withHeader('Content-Type: application/x-www-form-urlencoded')
            ->post();
        $res = json_decode($response);
        return $res;
    }

    public function checkTransaksi($idcustomer)
    {
        $response = Curl::to($this->link_check.'cek_transaksi')
            ->withData([
                'key' => $this->api_token,
                'nama' => $this->nameApp,
                'idcustomer' => $idcustomer
            ])
            ->withHeader('Content-Type: application/x-www-form-urlencoded')
            ->post();
        $res = json_decode($response);
        return $res;
    }
}
