<?php

namespace App\Http\Controllers;

use DB;
use Mail;
use Response;
use App\User;
use App\Price;
use App\Wallet;
use App\Setting;
use App\Balance;
use App\Program;
use App\Convert;
use App\LogActivity;
use App\Transaction;
use App\ConvertDetail;
use Illuminate\Support\Str;
use App\HistoryTransaction;
use Illuminate\Http\Request;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\LengthAwarePaginator;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Validation\Factory as ValidatonFactory;

class ConvertController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ValidatonFactory $factory)
    {
        $this->middleware('auth');
        $this->middleware('user-online');
        $factory->extend(
            'multiple',
            function ($attribute, $value, $parameters) {
                if ($value%1 == 0 ){
                    return true;
                }
            },
            'The amount must be a multiple of 1'
        );
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $my = number_format(Auth::user()->balance->where('description','USD Wallet')->first()->balance,2);
        $price = Price::where('status',0)->first()->price;
        $fee = Setting::where('name','Fee Convert')->first()->value;
        return view('backend.convert.index',compact('my','price','fee'));
    }

    public function send(Request $request)
    {
        $this->validate($request, [
            'amount'=>'required|numeric|gte:10',
            'security_password'=>'required'
        ]);

        $amount = $request->amount;
        $price = Price::where('status',0)->first()->price;
        $fee = Setting::where('name','Fee Convert')->first()->value;
        $amountFee = $amount * $fee;
        $total = $amount - $amountFee;
        $receive =  str_replace(',', '', number_format($total / $price,8));
        $hasPassword = Hash::check($request->security_password, Auth::user()->trx_password);
        if($hasPassword){
            $type_wallet = 'USD Wallet';
            $to_wallet = 'Trustme Coin';
            $description = 'Convert '.$type_wallet.' to '.$to_wallet;
            $cash = Auth::user()->balance()->where('description',$type_wallet)->first();
            if($amount <= $cash->balance){
                $user = Auth::user();
                $trans = Convert::where(['user_id'=>Auth::user()->id])->orderBy('created_at','desc')->first();
                if($trans){
                    $tgl = $trans->created_at;
                    $dt = date('Y-m-d H:i:s');
                    $selisih = strtotime($dt) - strtotime($tgl);
                    $minute = floor($selisih / 60);
                    if($minute >= 2){
                        $run = true;
                    }else{
                        $run = false;
                        $request->session()->flash('failed', 'Please wait to 2 minutes to do the next convert');
                    }
                }else{
                    $run = true;
                }

                if($run){
                    $total2 = 0;
                    $price2 = 0;
                    $receive2 = 0;
                    $priceDc = Price::where('status',0)->first();
                    if($receive <= $priceDc->rest){
                        $priceDc->sold = $priceDc->sold + $receive;
                        $priceDc->rest = $priceDc->rest - $receive;
                        if($priceDc->rest - $receive == 0){
                            $priceDc->status = 1;
                        }
                        $priceDc->save();
                    }else{
                        $amount_ = $priceDc->rest * $price;
                        $total2 = $total - $amount_;
                        $total = $amount_;
                        $receive =  str_replace(',', '', number_format($amount_ / $price,8));
                        $priceDc->sold = $priceDc->sold + $receive;
                        $priceDc->rest = $priceDc->rest - $receive;
                        if($priceDc->id < 6){
                            $priceDc->status = 1;
                        }
                        $priceDc->save();
                        $getPrice = Price::where('status',0)->first();
                        $price2 = $getPrice->price;
                        $receive2 =  str_replace(',', '', number_format($total2 / $price2,8));
                        $getPrice->sold = $getPrice->sold + $receive2;
                        $getPrice->rest = $getPrice->rest - $receive2;
                        $getPrice->save();
                    }

                    $invoice = 'INV'.time();
                    $convert = Convert::create([
                        'invoice' => $invoice,
                        'user_id' => Auth::user()->id,
                        'amount' => $amount,
                        'fee' => $amountFee,
                        'total' => $total,
                        'price'=> $price,
                        'receive' => $receive,
                        'status' => 1,
                        'description' => $description
                    ]);

                    if($total2 > 0){
                        ConvertDetail::create([
                            'convert_id' => $convert->id,
                            'total' => $total2,
                            'price'=> $price2,
                            'receive' => $receive2,
                        ]);
                    }

                    $receive = $receive + $receive2;
                    $cash->balance = $cash->balance - $amount;
                    $cash->save();

                    HistoryTransaction::create([
                        'balance_id' => $cash->id,
                        'from_id' => Auth::user()->id,
                        'to_id' => 1,
                        'amount' => $amount,
                        'description' => $description,
                        'status' => 1,
                        'type' => 'OUT'
                    ]);

                    // Admin
                    $balance_adm = Balance::where(['user_id'=> 1,'description'=> $type_wallet])->first();
                    $balance_adm->balance = $balance_adm->balance + $amount;
                    $balance_adm->save();

                    HistoryTransaction::create([
                        'balance_id' => $balance_adm->id,
                        'from_id' => Auth::user()->id,
                        'to_id' => 1,
                        'amount' => $amount,
                        'description' => $description.' from '.ucfirst(Auth::user()->username),
                        'status' => 1,
                        'type' => 'IN'
                    ]);

                    // Admin
                    $toWalletAdm = Balance::where(['user_id'=> 1,'description'=> $to_wallet])->first();
                    $toWalletAdm->balance = $toWalletAdm->balance - $receive;
                    $toWalletAdm->save();

                    HistoryTransaction::create([
                        'balance_id' => $toWalletAdm->id,
                        'from_id' => 1,
                        'to_id' => Auth::user()->id,
                        'amount' => $receive,
                        'description' => $description.' to '.ucfirst(Auth::user()->username),
                        'status' => 1,
                        'type' => 'OUT'
                    ]);

                    $toWallet = Auth::user()->balance()->where('description',$to_wallet)->first();
                    $toWallet->balance = $toWallet->balance + $receive;
                    $toWallet->save();

                    HistoryTransaction::create([
                        'balance_id' => $toWallet->id,
                        'from_id' => 1,
                        'to_id' => Auth::user()->id,
                        'amount' => $receive,
                        'description' => $description,
                        'status' => 1,
                        'type' => 'IN'
                    ]);

                    $request->session()->flash('success', 'Successfully, '.$description);
                }
            }else{
                $request->session()->flash('failed', 'Failed, You do not have enough funds to convert');
            }
        }else{
            $request->session()->flash('failed', 'Failed, Password is wrong');
        }
        return redirect()->back();
    }

    public function history(Request $request)
    {
    	$date = '';
        if($request->date){
            $date = date('Y-m-d',strtotime(str_replace('/', '-', $request->date)));
        }
        $data = Auth::user()
                ->convert()
                ->when($date,function ($cari) use ($date) {
                    return $cari->whereDate('created_at', $date);
                })
                ->orderBy('created_at','desc')
                ->paginate(20);
        $usd = Auth::user()
                ->convert()
                ->when($date,function ($cari) use ($date) {
                    return $cari->whereDate('created_at', $date);
                })
                ->sum('amount');
        $idr = Auth::user()
                ->convert()
                ->when($date,function ($cari) use ($date) {
                    return $cari->whereDate('created_at', $date);
                })
                ->sum(DB::raw('receive'));
        $arrID = Auth::user()
                ->convert()
                ->when($date,function ($cari) use ($date) {
                    return $cari->whereDate('created_at', $date);
                })->select('id')
                ->get()->toArray();
        $sum = ConvertDetail::whereIn('convert_id',$arrID)->sum('receive');
        $idr = $idr + $sum;
        return view('backend.convert.history',compact('data','date','usd','idr'))->with('i', (request()->input('page', 1) - 1) * 20);
    }

    public function list(Request $request)
    {
        $search = $request->search;
        $from_date = str_replace('/', '-', $request->from_date);
        $to_date = str_replace('/', '-', $request->to_date);
        $choose = $request->choose;

        if($from_date && $to_date){
            $from = date('Y-m-d',strtotime($from_date));
            $to = date('Y-m-d',strtotime($to_date));
        }else{
            $from = date('Y-m-d',strtotime('01/01/2018'));
            $to = date('Y-m-d');
            $from_date = '01/01/2018';
            $to_date = date('d/m/Y');
        }

        $status = [0,1,2,3,4];
        if($choose == 1){
            $status = [0];
        }elseif($choose == 2){
            $status = [1];
        }elseif($choose == 3){
            $status = [2];
        }elseif($choose == 4){
            $status = [3];
        }elseif($choose == 5){
            $status = [4];
        }

        $data = Convert::whereIn('status',$status)
            ->when($search, function ($query) use ($search){
                $query->whereHas('user', function ($cari) use ($search){
                    $cari->where('users.username', 'like', '%$search%');
                });
            })
            ->whereDate('created_at','>=',$from)
            ->whereDate('created_at','<=',$to)
            ->orderBy('created_at','desc')
            ->paginate(20);

        $total_usd = Convert::whereIn('status',$status)
            ->when($search, function ($query) use ($search){
                $query->whereHas('user', function ($cari) use ($search){
                    $cari->where('users.username', 'like', '%$search%');
                });
            })
            ->whereDate('created_at','>=',$from)
            ->whereDate('created_at','<=',$to)
            ->sum('amount');

        $total_idr = Convert::whereIn('status',$status)
            ->when($search, function ($query) use ($search){
                $query->whereHas('user', function ($cari) use ($search){
                    $cari->where('users.username', 'like', '%$search%');
                });
            })
            ->whereDate('created_at','>=',$from)
            ->whereDate('created_at','<=',$to)
            ->sum('receive');

        $arrID = Convert::whereIn('status',$status)
            ->when($search, function ($query) use ($search){
                    $query->whereHas('user', function ($cari) use ($search){
                        $cari->where('users.username', 'like', '%$search%');
                    });
                })
                ->whereDate('created_at','>=',$from)
                ->whereDate('created_at','<=',$to)
                ->select('id')
                ->get()->toArray();
        $sum = ConvertDetail::whereIn('convert_id',$arrID)->sum('receive');
        $total_idr = $total_idr + $sum;
        return view('backend.convert.list',compact('data','search','from_date','to_date','total_idr','total_usd','choose'))->with('i', (request()->input('page', 1) - 1) * 20);
    }

    public function generateCode()
    {
        return substr(str_shuffle(str_repeat('0123456789',10)),0,3);
    }
}
