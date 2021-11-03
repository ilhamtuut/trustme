<?php

namespace App\Http\Controllers;

use App\Price;
use App\Setting;
use App\Package;
use App\Program;
use App\BonusPasif;
use App\BonusActive;
use App\Facades\Eth;
use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('user-online');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $today = date('Y-m-d');
        $bonus_aktif = Auth::user()->bonus_active()->sum('bonus');
        $bonus_pasif = Auth::user()->bonus_pasif()->sum('bonus');
        $todayprogram = Auth::user()->bonus_active()->whereDate('created_at',$today)->sum('bonus');
        $todaypasif = Auth::user()->bonus_pasif()->whereDate('created_at',$today)->sum('bonus');
        $totalEarn = number_format(($bonus_aktif + $bonus_pasif),2);
        $todayEarn = number_format(($todayprogram + $todaypasif),2);

        $package = number_format(Auth::user()->program()->where('status','!=',1)->sum('amount'),2);
        $usd = number_format(Auth::user()->balance()->where('description','USD Wallet')->first()->balance,2);
        $trustme = number_format(Auth::user()->balance()->where('description','Trustme Coin')->first()->balance,8);
        $register = number_format(Auth::user()->balance()->where('description','Register Wallet')->first()->balance,2);
        $max_profit = Auth::user()->program()->sum('max_profit');
        $used_bonus = $max_profit - ($bonus_aktif + $bonus_pasif);
        $percent = 0;
        if($max_profit > 0){
            $percent = round((($bonus_pasif + $bonus_aktif) / $max_profit) * 100,2);
        }
        $price = Price::get();
        return view('home',compact('totalEarn','todayEarn','package','trustme','usd','register','bonus_aktif','bonus_pasif','max_profit','used_bonus','percent','price'));
    }

    public function pricing(Request $request)
    {
        $package = Package::get();
        return view('pricing',compact('package'));
    }
}
