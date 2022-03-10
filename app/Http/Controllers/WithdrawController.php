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
use App\Withdraw;
use App\LogActivity;
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

class WithdrawController extends Controller
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
        $min = Setting::where('name', 'Minimal Withdrawal')->first()->value;
        $min_spartan = Setting::where('name', 'Minimal Withdrawal Spartan')->first()->value;

        $factory->extend(
            'greater_than',
            function ($attribute, $value, $parameters, $validator) use ($min) {
                if($value >= $min){
                    return true;
                }
            },
            'The amount must be greater than '.$min
        );

        $factory->extend(
            'min_spartan',
            function ($attribute, $value, $parameters, $validator) use ($min_spartan) {
                if($value >= $min_spartan){
                    return true;
                }
            },
            'The amount must be greater than '.$min_spartan
        );

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
        $user = Auth::user();
        $my = number_format($user->balance()->where('description','Trustme Coin')->first()->balance,8);
        $fee = Setting::where('name','Fee Withdrawal')->first()->value;
        $min = Setting::where('name','Minimal Withdrawal')->first()->value;
        $price = Price::where('status',0)->first()->price;
        $address = '';
        if($user->wallet()->where('status',1)->first()){
            $address = $user->wallet()->where('status',1)->first()->address;
        }
        return view('backend.withdraw.index',compact('fee','min','my','address','price'));
    }

    public function spartan(Request $request)
    {
        $user = Auth::user();
        $my = number_format($user->balance()->where('description','Spartan Coin')->first()->balance,8);
        $fee = Setting::where('name','Fee Withdrawal Spartan')->first()->value;
        $min = Setting::where('name','Minimal Withdrawal Spartan')->first()->value;
        $address = '';
        if($user->wallet()->where('status',2)->first()){
            $address = $user->wallet()->where('status',2)->first()->address;
        }
        return view('backend.withdraw.spartan',compact('fee','min','my','address'));
    }

    public function withdraw(Request $request,$type)
    {
        $status = 1;
        $currency = 'TC';
        $currencyNama = 'Trustme Coin';
        $name_wd = 'Fee Withdrawal';
        $price = Price::where('status',0)->first()->price;
        $required_amount = 'required|numeric|greater_than';
        if($type == 'spartan'){
            $price = 0;
            $status = 2;
            // $currency = 'SPARTAN';
            // $currencyNama = 'Spartan Coin';
            $currency = 'CBC';
            $currencyNama = 'CAPRABULLCOIN';
            $name_wd = 'Fee Withdrawal Spartan';
            $required_amount = 'required|numeric|min_spartan';
        }

        $this->validate($request, [
            'address' =>'required|string|max:50',
            'amount'=>$required_amount,
            'security_password'=>'required'
        ]);

        $hasPassword = Hash::check($request->security_password, Auth::user()->trx_password);
        if($hasPassword){
            $type_wallet = ucfirst($type).' Coin';
            $fee_wd = Setting::where('name',$name_wd)->first()->value;
            $description = 'Withdrawal '.ucfirst($currencyNama);
            // $coin = Auth::user()->wallet()->where('status',$status)->first();
            // if(is_null($coin)){
            //     $coin = Wallet::create([
            //         'user_id' => Auth::id(),
            //         'name' => ucfirst($type).' Coin',
            //         'currency' => $currency,
            //         'address' => $request->address,
            //         'key' => $request->address,
            //         'status' => $status
            //     ]);
            // }
            $data_json = array(
                'name' => $currencyNama,
                'currency' => $currency,
                'address' => $request->address
            );
            $amount = $request->amount;
            $total = $amount * $price;
            $fee = $amount * $fee_wd;
            $receive = $amount - $fee;
            $cash = Auth::user()->balance()->where('description',$type_wallet)->first();
            if($amount <= $cash->balance){
                $checkWd = Withdraw::where([
                        'user_id'=>Auth::user()->id, 'status'=>0
                    ])->first();
                if(is_null($checkWd)){
                    $trans = Withdraw::where(['user_id'=>Auth::user()->id])->orderBy('created_at','desc')->first();
                    if($trans){
                        $tgl = $trans->created_at;
                        $dt = date('Y-m-d H:i:s');
                        $selisih = strtotime($dt) - strtotime($tgl);
                        $minute = floor($selisih / 60);
                        if($minute >= 2){
                            $run = true;
                        }else{
                            $run = false;
                            $request->session()->flash('failed', 'Please wait to 2 minutes to do the next Withdrawal');
                        }
                    }else{
                        $run = true;
                    }

                    if($run){
                        $invoice = 'INV'.time();
                        Withdraw::create([
                            'invoice' => $invoice,
                            'user_id' => Auth::user()->id,
                            'amount' => $amount,
                            'price'=> $price,
                            'total'=> $total,
                            'fee' => $fee,
                            'receive' => $receive,
                            'status' => 0,
                            'type' => $type,
                            'description' => $description,
                            'json' => json_encode($data_json)
                        ]);

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
                            'description' => $description.' From '.ucfirst(Auth::user()->username),
                            'status' => 1,
                            'type' => 'IN'
                        ]);

                        $request->session()->flash('success', 'Successfully, '.$description);
                    }
                }else{
                    $request->session()->flash('failed', 'Failed, Please wait for the previous withdrawal process to complete to be able to make a withdrawal');
                }
            }else{
                $request->session()->flash('failed', 'Failed, You do not have enough funds to Withdrawal');
            }
        }else{
            $request->session()->flash('failed', 'Failed, Password is wrong');
        }
        return redirect()->back();
    }

    public function history_withdraw(Request $request)
    {
    	$date = '';
        $type = $request->type;
        if($request->date){
            $date = date('Y-m-d',strtotime(str_replace('/', '-', $request->date)));
        }
        $data = Auth::user()
                ->withdraw()
                ->when($date,function ($cari) use ($date) {
                    return $cari->whereDate('created_at', $date);
                })
                ->when($type,function ($cari) use ($type) {
                    return $cari->where('type', $type);
                })
                ->orderBy('created_at','desc')
                ->paginate(20);
        $amount = Auth::user()
                ->withdraw()
                ->when($date,function ($cari) use ($date) {
                    return $cari->whereDate('created_at', $date);
                })
                ->when($type,function ($cari) use ($type) {
                    return $cari->where('type', $type);
                })
                ->sum('amount');
        $total = Auth::user()
                ->withdraw()
                ->when($date,function ($cari) use ($date) {
                    return $cari->whereDate('created_at', $date);
                })
                ->when($type,function ($cari) use ($type) {
                    return $cari->where('type', $type);
                })
                ->sum('total');
        $fee = Auth::user()
                ->withdraw()
                ->when($date,function ($cari) use ($date) {
                    return $cari->whereDate('created_at', $date);
                })
                ->when($type,function ($cari) use ($type) {
                    return $cari->where('type', $type);
                })
                ->sum('fee');
        $receive = Auth::user()
                ->withdraw()
                ->when($date,function ($cari) use ($date) {
                    return $cari->whereDate('created_at', $date);
                })
                ->when($type,function ($cari) use ($type) {
                    return $cari->where('type', $type);
                })
                ->sum('receive');
        return view('backend.withdraw.history_withdraw',compact('data','date','amount','total','fee','receive'))->with('i', (request()->input('page', 1) - 1) * 20);
    }

    public function list_withdraw(Request $request,$type)
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
        }

        $data = Withdraw::whereIn('status',$status)
            ->when($search, function ($query) use ($search){
                $query->whereHas('user', function ($cari) use ($search){
                    $cari->where('users.username', 'like', $search.'%');
                })->orwhere('invoice',$search);
            })
            ->where('type',$type)
            ->whereDate('created_at','>=',$from)
            ->whereDate('created_at','<=',$to)
            ->orderBy('created_at','desc')
            ->paginate(20);

        $amount = Withdraw::whereIn('status',$status)
            ->when($search, function ($query) use ($search){
                $query->whereHas('user', function ($cari) use ($search){
                    $cari->where('users.username', 'like', $search.'%');
                })->orWhere('invoice',$search);
            })
            ->where('type',$type)
            ->whereDate('created_at','>=',$from)
            ->whereDate('created_at','<=',$to)
            ->sum('amount');
        $total = Withdraw::whereIn('status',$status)
            ->when($search, function ($query) use ($search){
                $query->whereHas('user', function ($cari) use ($search){
                    $cari->where('users.username', 'like', $search.'%');
                })->orWhere('invoice',$search);
            })
            ->where('type',$type)
            ->whereDate('created_at','>=',$from)
            ->whereDate('created_at','<=',$to)
            ->sum('total');
        $fee = Withdraw::whereIn('status',$status)
            ->when($search, function ($query) use ($search){
                $query->whereHas('user', function ($cari) use ($search){
                    $cari->where('users.username', 'like', $search.'%');
                })->orWhere('invoice',$search);
            })
            ->where('type',$type)
            ->whereDate('created_at','>=',$from)
            ->whereDate('created_at','<=',$to)
            ->sum('fee');
        $receive = Withdraw::whereIn('status',$status)
            ->when($search, function ($query) use ($search){
                $query->whereHas('user', function ($cari) use ($search){
                    $cari->where('users.username', 'like', $search.'%');
                })->orWhere('invoice',$search);
            })
            ->where('type',$type)
            ->whereDate('created_at','>=',$from)
            ->whereDate('created_at','<=',$to)
            ->sum('receive');
        return view('backend.withdraw.list_withdraw',compact('data','search','from_date','to_date','receive','amount','choose','type','total','fee'))->with('i', (request()->input('page', 1) - 1) * 20);
    }

    public function accept(Request $request, $id)
    {
        $this->validate($request, [
            'txid'=>'required',
            'security_password'=>'required'
        ]);
        $user = Auth::user();
        $hasPassword = Hash::check($request->security_password, $user->trx_password);
        if($hasPassword){
            $withdraw = Withdraw::find($id);
            $json = json_decode($withdraw->json,true);
            $json['txid'] = $request->txid;
            $json['accepted_at'] = date('Y-m-d H:i:s');
            $withdraw->json = json_encode($json);
            $withdraw->status = 1;
            $withdraw->save();

            LogActivity::create([
                'user_id' => Auth::user()->id,
                'activity' => 'Accept withdrawal username : '.ucfirst($withdraw->user->username).' WDID : '.$id,
                'status' => 1
            ]);
            $request->session()->flash('success', 'Success, Accept withdrawal Username '.ucfirst($withdraw->user->username));
        }else{
            $request->session()->flash('failed', 'Failed, security password is wrong');
        }
        return redirect()->back();
    }

    public function reject(Request $request, $id)
    {
        $withdraw = Withdraw::find($id);
        $withdraw->status = 2;
        $withdraw->save();

        $amount = $withdraw->amount;
        $name_wallet = 'Trustme Coin';

        $balance = Balance::where(['user_id'=>1,'description'=>$name_wallet])->first();
        $balance->balance = $balance->balance - $amount;
        $balance->save();

        HistoryTransaction::create([
            'balance_id'=>$balance->id,
            'from_id'=> 1,
            'to_id'=> $withdraw->user_id,
            'amount'=> $amount,
            'description'=> 'Reject '.$withdraw->description.' Username '.ucfirst($withdraw->user->username),
            'status'=> 1,
            'type'=> 'OUT'
        ]);

        $saldo = Balance::where(['user_id'=> $withdraw->user_id,'description'=>$name_wallet])->first();
        $saldo->balance = $saldo->balance + $amount;
        $saldo->save();

        HistoryTransaction::create([
            'balance_id'=> $saldo->id,
            'from_id'=> 1,
            'to_id'=> $withdraw->user_id,
            'amount'=> $amount,
            'description'=> 'Reject '.$withdraw->description,
            'status'=> 1,
            'type'=> 'IN'
        ]);

        LogActivity::create([
            'user_id' => Auth::user()->id,
            'activity' => 'Reject withdrawal '.$withdraw->description.' ID : '.$id,
            'status' => 1
        ]);
        $request->session()->flash('success', 'Success, Reject withdrawal');
        return Response::json(['success'=>1]);
    }

    public function generateCode()
    {
        return substr(str_shuffle(str_repeat('0123456789',10)),0,3);
    }
}
