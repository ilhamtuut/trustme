<?php

namespace App\Http\Controllers;

use Web3\Web3;
use Web3\Utils;
use App\User;
use App\Wallet;
use App\Balance;
use App\Setting;
use Carbon\Carbon;
use App\Facades\Eth;
use App\Transaction;
use App\Helpers\Finetech;
use App\HistoryTransaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;

class WalletController extends Controller
{
	public function index(Request $request)
	{
        return redirect()->back();
		// return view('backend.wallet.usdt.index');
	}

	public function addWallet(Request $request)
	{
        $validator = Validator::make($request->all(), [
            'address' => 'required',
            'key' => 'required'
        ]);

        if ($validator->passes()){
	        Wallet::create([
	        	'user_id' => Auth::id(),
	        	'name' => 'Trustme Coin',
		        'currency' => 'TC',
		        'address' => $request->address,
		        'key' => $request->key,
		    	'status' => 1
	        ]);

	        $request->session()->flash('success', 'Successfully, Create Trustme Coin Address');
	        $data = array(
                'success' => true
            );
        }else{
	        $request->session()->flash('failed', 'Failed, Create Trustme Coin Address, Please Try Again');
            $data = array(
                'success' => false
            );
        }
        return response()->json($data);
	}

	public function myWallet(Request $request)
	{
		$search = $request->search;
		$address = null;
		$balanceEth = 0;
		$balanceErc = 0;
		if(Auth::user()->wallet){
			$address = Auth::user()->wallet->address;
			$balanceEth = Eth::toEth(Eth::balance($address),18);
			$balanceErc = Eth::toEth(Eth::balanceErc($address),18);
		}
		$data = Auth::user()->transactions()
				->when($search, function ($query) use ($search){
					$query->where('trx_id',$search);
				})
				->orderBy('id','desc')->paginate(20);
		// $balanceEth = number_format($balanceEth,8);
		// $balanceErc = number_format($balanceErc,8);
        // $saldo = number_format(Auth::user()->balance->where('description','Dinasty Coin')->first()->balance,8);
        $saldo = Auth::user()->balance->where('description','Trustme Coin')->first()->balance;
        $min = Setting::where('name','Min Send TC')->first()->value;
        $isShow = Setting::where('name','Show Balance n Address TC')->first()->value;
		return view('backend.wallet.usdt.mywallet',compact('address','saldo','data','balanceEth','balanceErc','min','isShow'))->with('i', (request()->input('page', 1) - 1) * 20);
	}

	public function sendCoin(Request $request)
	{
        $min = Setting::where('name','Min Send TC')->first()->value;
		$this->validate($request, [
            'address'=> 'required',
            'amount'=> 'required|numeric|gte:'.$min
        ]);

        $user = Auth::user();
        $myWallet = $user->wallet;
		if($myWallet){
	        $today = Carbon::now();
	        $wallet = 'Trustme Coin';
	        $amount = $request->amount;
	        $toAddress = $request->address;
			$fromAddress = $myWallet->address;
	        $register = $user->balance()->where('description',$wallet)->first();
	        $is_valid = Eth::addrValid($toAddress);
	        if($is_valid && $fromAddress != $toAddress){
	            if($amount <= $register->balance){
	            	$send = false;
	            	$checkAddress = Wallet::where('address',$toAddress)->first();
	            	if($checkAddress){
		            	$send = true;
	            		$trx_id = 'TRF'.time();
		            	$type = 'Internal';
	            		$to_id = $checkAddress->user_id;
	            		$status = 1;
                        $fee = 0;
	            	}else{
		            	$send = true;
		            	$trx_id = null;
		            	$type = 'External';
		            	$to_id = 1;
	            		$status = 0;
                        $fee = Setting::where('name','Fee Send TC EX')->first()->value;
                        $checkFinetech = (new Finetech)->checkAddress($toAddress);
                        if($checkFinetech->message){
                            $fee = Setting::where('name','Fee Send TC IN')->first()->value;
                        }
	            	}
                    $amountfee = $amount * $fee;
                    $estimated = $amount - $amountfee;
	            	if($send){
	            		$user_to = User::find($to_id);
            			$description = 'Send '.$type.' TC Address';
            			$code = Str::random(6);
            			Transaction::create([
            				'user_id' => Auth::id(),
					        'trx_id' => $trx_id,
					        'from_address' => $fromAddress,
					        'to_address' => $toAddress,
					        'amount' => $amount,
                            'fee'=>$fee,
                            'receive'=>$estimated,
					        'status' => $status,
					        'type' => $type,
					    	'description' => $description,
					    	'code' => $code
            			]);
		                // update wallet register pengirim
		                $register->balance = $register->balance - $request->amount;
		                $register->save();

		                HistoryTransaction::create([
		                    'balance_id'=>$register->id,
		                    'from_id'=>Auth::user()->id,
		                    'to_id'=>$user_to->id,
		                    'amount'=> $request->amount,
		                    'description'=> $description,
		                    'status'=> 1,
		                    'type'=> 'OUT'
		                ]);

		                Transaction::create([
            				'user_id' => $user_to->id,
					        'trx_id' => $trx_id,
					        'from_address' => $fromAddress,
					        'to_address' => $toAddress,
					        'amount' => $amount,
                            'fee'=>$fee,
                            'receive'=>$estimated,
					        'status' => $status,
					        'type' => $type,
					    	'description' => $description,
					    	'code' => $code
            			]);

		                // update wallet register penerima
	            		$register_to = $user_to->balance()->where('description',$wallet)->first();
		                $register_to->balance = $register_to->balance + $request->amount;
		                $register_to->save();

		                HistoryTransaction::create([
		                    'balance_id'=>$register_to->id,
		                    'from_id'=>Auth::user()->id,
		                    'to_id'=>$user_to->id,
		                    'amount'=> $request->amount,
		                    'description'=> $description,
		                    'status'=> 1,
		                    'type'=> 'IN'
		                ]);

		                $request->session()->flash('success', 'Successfully, send TC to '.$toAddress);
	            	}else{
	                	$request->session()->flash('failed', 'Failed to Send TC, please try again later');
	            	}
	            }else{
	                $request->session()->flash('failed', 'Your balance not enough');
	            }
	        }else{
	            $request->session()->flash('failed', 'Address not valid');
	        }
	    }else{
            $request->session()->flash('failed', 'Please create address wallet first');
	    }
        return redirect()->back();
	}

	public function list(Request $request)
	{
		$search = $request->search;
		$data = Wallet::when($search, function ($query) use ($search){
					$query->whereHas('user', function ($q) use ($search)
					{
						$q->where('users.username','like','%'.$search.'%');
					});
				})->paginate(20);
		return view('backend.wallet.usdt.list', compact('data'))->with('i', (request()->input('page', 1) - 1) * 20);
	}

    public function checkAddress($address)
    {
        $is_valid = Eth::addrValid($address);
        if($is_valid){
            $checkAddress = Wallet::where('address',$address)->first();
            if($checkAddress){
                return response()->json(['success'=>true,'data'=>['type'=>'Address Internal','fee'=> 0]]);
            }else{
                $checkFinetech = (new Finetech)->checkAddress($address);
                if($checkFinetech->message){
                    $fee = Setting::where('name','Fee Send TC IN')->first()->value;
                    return response()->json(['success'=>true,'data'=>['type'=>'Address External Finetech','fee'=> $fee]]);
                }
                $fee = Setting::where('name','Fee Send TC EX')->first()->value;
                return response()->json(['success'=>true,'data'=>['type'=>'Address External','fee'=> $fee]]);
            }
        }else{
            return response()->json(['success'=>false,'message'=>'Address invalid']);
        }
    }
}
