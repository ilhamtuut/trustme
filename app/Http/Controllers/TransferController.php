<?php

namespace App\Http\Controllers;

use Response;
use App\User;
use App\Balance;
use Carbon\Carbon;
use App\HistoryTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class TransferController extends Controller
{
    public function index(Request $request, $type)
    {
        if($type == 'register_wallet' || $type == 'trustme_coin'){
            $wallet = str_replace("_", " ", $type);
            $saldo = Auth::user()->balance()->where('description', $wallet)->first();
            return view('backend.wallet.transfer',compact('saldo','type'));
        }else{
            return redirect()->route('home');
        }
    }

	public function send(Request $request, $type)
	{
        $this->validate($request, [
            'amount'=> 'required|numeric|gte:1',
            'username'=> 'required',
            'security_password' => 'required|string|min:6'
        ]);

        $wallet = str_replace("_", " ", $type);
        $users = User::where('username', Auth::user()->username)->first();
        $register = $users->balance()->where('description',$wallet)->first();
        $password = $request->security_password;
        $hasPassword = Hash::check($password, $users->trx_password);
        $today = Carbon::now();
        if($hasPassword){
            $username = $request->username;
            $user_to = User::where('username','!=',Auth::user()->username)
                            ->where('username',$username)
                            ->first();
            if($user_to){
                $id = $user_to->id;
                if($request->amount <= $register->balance){
                    $register_to = $user_to->balance()->where('description',$wallet)->first();
                    $trans = HistoryTransaction::where(['from_id'=>Auth::user()->id,'description'=>'Transfer '.$wallet])->orderBy('created_at','desc')->first();
                    if($trans){
                        $tgl = $trans->created_at;
                        $dt = Carbon::now();
                        $selisih = strtotime($dt) - strtotime($tgl);
                        $minute = floor($selisih / 60);
                        if($minute >= 2){
                            $run = true;
                        }else{
                            $run = false;
                            $request->session()->flash('failed', 'Please wait to 2 minutes to do the next transfer');
                        }
                    }else{
                        $run = true;
                    }

                    if($run){
                        // update wallet register pengirim
                        $register->balance = $register->balance - $request->amount;
                        $register->save();

                        HistoryTransaction::create([
                            'balance_id'=>$register->id,
                            'from_id'=>Auth::user()->id,
                            'to_id'=>$user_to->id,
                            'amount'=> $request->amount,
                            'description'=> 'Transfer '.$wallet,
                            'status'=> 1,
                            'type'=> 'OUT'
                        ]);

                        // update wallet register penerima
                        $register_to->balance = $register_to->balance + $request->amount;
                        $register_to->save();

                        HistoryTransaction::create([
                            'balance_id'=>$register_to->id,
                            'from_id'=>Auth::user()->id,
                            'to_id'=>$user_to->id,
                            'amount'=> $request->amount,
                            'description'=> 'Transfer '.$wallet,
                            'status'=> 1,
                            'type'=> 'IN'
                        ]);

                        $request->session()->flash('success', 'Successfully, Transfer '.$wallet);
                    }
                }else{
                    $request->session()->flash('failed', 'Your balance not enough');
                }
            }else{
                $request->session()->flash('failed', 'Username not found');
            }
        }else{
            $request->session()->flash('failed', 'Password is wrong');
        }
        return redirect()->back();
    }

    public function check(Request $request)
    {
        $username = $request->username;
        $user = User::where(['username'=>$username])->first();
        if($user){
            $name = $user->name;
            $username = $user->username;
            return Response::json(['success' => true,'username'=>ucfirst($username),'name'=>ucfirst($name)]);
        }else{
            return Response::json(['success' => false]);
        }
    }
}
