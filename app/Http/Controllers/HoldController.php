<?php

namespace App\Http\Controllers;

use App\User;
use App\HoldTmc;
use App\Setting;
use App\Balance;
use App\HistoryTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Factory as ValidatonFactory;

class HoldController extends Controller
{
    public function __construct(ValidatonFactory $factory)
    {
        $this->middleware('auth');
        $this->middleware('user-online');
        $min = Setting::where('name', 'Minimal Hold')->first()->value;

        $factory->extend(
            'greater_than',
            function ($attribute, $value, $parameters, $validator) use ($min) {
                if($value >= $min){
                    return true;
                }
            },
            'The amount must be greater than '.$min
        );
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        $rate = Setting::where('name','1 TMC')->first()->value;
        $min = Setting::where('name','Minimal Hold')->first()->value;
        $timer = Setting::where('name','Hold Timer')->first()->value;
        $contract = '0xbB46025A7B450312ce17b25d85A4A12eCb21d0E2';
        $hold_timer = 0;
        $data = $user->holder()->select('expired_at')->orderBy('expired_at','desc')->first();
        if($data){
            $now = strtotime(date('Y-m-d'));
            $expired_at = strtotime($data->expired_at);
            $difference = $expired_at - $now;
            $hold_timer = $difference / 60 / 60 / 24;
        }
        $my = number_format($user->balance()->where('description','Trustme Coin')->first()->balance,8);
        $spartan = number_format($user->balance()->where('description','Spartan Coin')->first()->balance,8);
        return view('backend.holder.index', compact('my','spartan','min','timer','contract','rate','hold_timer'));
    }

    public function holder(Request $request)
    {
        $this->validate($request, [
            'amount'=>'required|numeric|greater_than',
            'security_password'=>'required'
        ]);

        $user = Auth::user();
        $hasPassword = Hash::check($request->security_password, $user->trx_password);
        if($hasPassword){
            $request->session()->flash('failed', 'Failed, Security Password is wrong');
            return redirect()->back();
        }

        $type_wallet = 'Trustme Coin';
        $rate = Setting::where('name','1 TMC')->first()->value;
        $timer = Setting::where('name','Hold Timer')->first()->value;
        $description = 'Holder Bounty CAPRABULLCOIN';

        $amount = $request->amount;
        $total = $amount * $rate;
        $date = date('Y-m-d');
        $expired_at = date('Y-m-d', strtotime($date. ' + '.$timer.' days'));
        $cash = $user->balance()->where('description',$type_wallet)->first();
        if($amount > $cash->balance){
            $request->session()->flash('failed', 'Failed, You do not have enough funds');
            return redirect()->back();
        }

        HoldTmc::create([
            'user_id' => $user->id,
            'amount' => $amount,
            'rate'=> $rate,
            'total'=> $total,
            'expired_at' => $expired_at,
            'status' => 0,
            'description' => $description
        ]);

        $cash->balance = $cash->balance - $amount;
        $cash->save();

        HistoryTransaction::create([
            'balance_id' => $cash->id,
            'from_id' => $user->id,
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
            'from_id' => $user->id,
            'to_id' => 1,
            'amount' => $amount,
            'description' => $description.' From '.ucfirst($user->username),
            'status' => 1,
            'type' => 'IN'
        ]);

        // spartancoin

        // Admin
        $spartan_adm = Balance::where(['user_id'=> 1,'description'=> 'Spartan coin'])->first();
        $spartan_adm->balance = $spartan_adm->balance - $total;
        $spartan_adm->save();

        HistoryTransaction::create([
            'balance_id' => $spartan_adm->id,
            'from_id' => 1,
            'to_id' => $user->id,
            'amount' => $total,
            'description' => $description.' To '.ucfirst($user->username),
            'status' => 1,
            'type' => 'OUT'
        ]);

        $spartan = $user->balance()->where('description','Spartan coin')->first();
        $spartan->balance = $spartan->balance + $total;
        $spartan->save();

        HistoryTransaction::create([
            'balance_id' => $spartan->id,
            'from_id' => 1,
            'to_id' => $user->id,
            'amount' => $total,
            'description' => $description,
            'status' => 1,
            'type' => 'IN'
        ]);

        $request->session()->flash('success', 'Successfully, '.$description);
        return redirect()->back();
    }

    public function history(Request $request)
    {
    	$date = '';
        if($request->date){
            $date = date('Y-m-d',strtotime(str_replace('/', '-', $request->date)));
        }
        $data = Auth::user()
                ->holder()
                ->when($date,function ($cari) use ($date) {
                    return $cari->whereDate('created_at', $date);
                })
                ->orderBy('created_at','desc')
                ->paginate(20);
        $amount = Auth::user()
                ->holder()
                ->when($date,function ($cari) use ($date) {
                    return $cari->whereDate('created_at', $date);
                })
                ->sum('amount');
        $total = Auth::user()
                ->holder()
                ->when($date,function ($cari) use ($date) {
                    return $cari->whereDate('created_at', $date);
                })
                ->sum('total');
        return view('backend.holder.history',compact('data','date','amount','total'))->with('i', (request()->input('page', 1) - 1) * 20);
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
        }

        $data = HoldTmc::whereIn('status',$status)
            ->when($search, function ($query) use ($search){
                $query->whereHas('user', function ($cari) use ($search){
                    $cari->where('users.username', 'like', $search.'%');
                })->orwhere('invoice',$search);
            })
            ->whereDate('created_at','>=',$from)
            ->whereDate('created_at','<=',$to)
            ->orderBy('created_at','desc')
            ->paginate(20);

        $amount = HoldTmc::whereIn('status',$status)
            ->when($search, function ($query) use ($search){
                $query->whereHas('user', function ($cari) use ($search){
                    $cari->where('users.username', 'like', $search.'%');
                })->orWhere('invoice',$search);
            })
            ->whereDate('created_at','>=',$from)
            ->whereDate('created_at','<=',$to)
            ->sum('amount');
        $total = HoldTmc::whereIn('status',$status)
            ->when($search, function ($query) use ($search){
                $query->whereHas('user', function ($cari) use ($search){
                    $cari->where('users.username', 'like', $search.'%');
                })->orWhere('invoice',$search);
            })
            ->whereDate('created_at','>=',$from)
            ->whereDate('created_at','<=',$to)
            ->sum('total');
        return view('backend.holder.list',compact('data','search','from_date','to_date','amount','choose','total'))->with('i', (request()->input('page', 1) - 1) * 20);
    }
}
