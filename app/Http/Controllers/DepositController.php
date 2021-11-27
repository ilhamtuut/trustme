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
use App\Deposit;
use App\LogActivity;
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

class DepositController extends Controller
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
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $address = '0x9683b8314e66c310ce74c0b59A57090d5A09b9Fd';
        return view('backend.deposit.index',compact('address'));
    }

    public function send(Request $request)
    {
        $this->validate($request, [
            'txid'=>'required|string|max:65',
            'amount'=>'required|numeric|gte:10'
        ]);

        $user = Auth::user();
        $txid = $request->txid;
        $amount = $request->amount;
        $hasPassword = Hash::check($request->security_password, $user->trx_password);
        if($hasPassword){
            $description = 'Deposit Trustme Coin';
            $trans = Deposit::where(['user_id'=>$user->id,'status'=>0])->orderBy('created_at','desc')->first();
            if($trans){
                $request->session()->flash('failed', 'Please wait for the previous deposit process to complete to be able to make a new deposit');
                return redirect()->back();
            }

            $invoice = 'DPT'.time();
            $convert = Deposit::create([
                'invoice' => $invoice,
                'user_id' => $user->id,
                'amount' => $amount,
                'txid' => $txid,
                'status' => 0,
                'description' => $description
            ]);

            $request->session()->flash('success', 'Successfully request '.$description);
        }else{
            $request->session()->flash('failed', 'Failed, Security Password is wrong');
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
                ->deposit()
                ->when($date,function ($cari) use ($date) {
                    return $cari->whereDate('created_at', $date);
                })
                ->orderBy('created_at','desc')
                ->paginate(20);
        $total = Auth::user()
                ->deposit()
                ->when($date,function ($cari) use ($date) {
                    return $cari->whereDate('created_at', $date);
                })
                ->sum('amount');
        return view('backend.deposit.history',compact('data','date','total'))->with('i', (request()->input('page', 1) - 1) * 20);
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

        $data = Deposit::whereIn('status',$status)
            ->when($search, function ($query) use ($search){
                $query->whereHas('user', function ($cari) use ($search){
                    $cari->where('users.username', 'like', '%$search%');
                });
            })
            ->whereDate('created_at','>=',$from)
            ->whereDate('created_at','<=',$to)
            ->orderBy('created_at','desc')
            ->paginate(20);

        $total = Deposit::whereIn('status',$status)
            ->when($search, function ($query) use ($search){
                $query->whereHas('user', function ($cari) use ($search){
                    $cari->where('users.username', 'like', '%$search%');
                });
            })
            ->whereDate('created_at','>=',$from)
            ->whereDate('created_at','<=',$to)
            ->sum('amount');
        return view('backend.deposit.list',compact('data','search','from_date','to_date','total','choose'))->with('i', (request()->input('page', 1) - 1) * 20);
    }

    public function confirm(Request $request,$type,$id)
    {
        $deposit = Deposit::find($id);
        $status = 2;
        $activity = 'Reject deposit username : '.ucfirst($deposit->user->username).' Invoice ID : '.$deposit->invoice;
        if($type == 'accept'){
            $status = 1;
            $amount = $deposit->amount;
            $name_wallet = 'Trustme Coin';
            $activity = 'Accept deposit username : '.ucfirst($deposit->user->username).' Invoice ID : '.$deposit->invoice;
            $balance = Balance::where(['user_id'=>1,'description'=>$name_wallet])->first();
            $balance->balance = $balance->balance - $amount;
            $balance->save();

            HistoryTransaction::create([
                'balance_id'=>$balance->id,
                'from_id'=> 1,
                'to_id'=> $deposit->user_id,
                'amount'=> $amount,
                'description'=> 'Accept Deposit Trustme Coin Username '.ucfirst($deposit->user->username),
                'status'=> 1,
                'type'=> 'OUT'
            ]);

            $saldo = Balance::where(['user_id'=> $deposit->user_id,'description'=>$name_wallet])->first();
            $saldo->balance = $saldo->balance + $amount;
            $saldo->save();

            HistoryTransaction::create([
                'balance_id'=> $saldo->id,
                'from_id'=> 1,
                'to_id'=> $deposit->user_id,
                'amount'=> $amount,
                'description'=> 'Deposit Trustme Coin',
                'status'=> 1,
                'type'=> 'IN'
            ]);
        }

        $deposit->status = $status;
        $deposit->save();
        LogActivity::create([
            'user_id' => Auth::user()->id,
            'activity' => $activity,
            'status' => 1
        ]);
        $request->session()->flash('success', 'Success, '.$activity);
        return response()->json(['success'=>1]);
    }
}
