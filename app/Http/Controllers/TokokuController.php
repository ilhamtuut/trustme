<?php

namespace App\Http\Controllers;

use Auth;
use App\Price;
use App\Setting;
use App\Helpers\Ppob;
use App\Helpers\Finetech;
use Illuminate\Http\Request;

class TokokuController extends Controller
{
    public function index(Request $request)
    {
        $priceDC = Price::where('status',0)->first()->price;
        $kurs = Setting::where('name','USD/IDR')->first()->value;
        $fee = Setting::where('name','Fee Purchase')->first()->value;
        $price = $priceDC * $kurs;
        $saldo = Auth::user()->balance()->where('description','Dinasty Coin')->first()->balance;
        return view('backend.tokoku.index',compact('saldo','price','fee'));
    }

    public function item(Request $request)
    {
        $phone_number = $request->phone_number;
        $result = (new Ppob)->pulsa($phone_number);
        $pulsa = collect($result)->where('jenis', 'pulsa')->sortBy('harga')->values()->all();
        $paket_data = collect($result)->where('jenis', 'paket data')->sortBy('harga')->values()->all();
        return response()->json(['success'=>true, 'data'=>['pulsa'=>$pulsa, 'paket_data'=>$paket_data]]);
    }

    public function buy(Request $request)
    {
        dd($request->all());
    }
}
