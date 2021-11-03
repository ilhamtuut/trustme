<?php

namespace App\Http\Controllers\Api;

use Web3\Web3;
use Web3\Utils;
use App\User;
use App\Wallet;
use App\Balance;
use Carbon\Carbon;
use App\Facades\Eth;
use App\Transaction;
use App\HistoryTransaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    public function isValid(Request $request,$address)
    {
        $valid = false;
        $is_valid = Wallet::where('address',$address)->first();
        if($is_valid){
            $valid = true;
        }
        return response()->json(['success'=>true,'data'=>['valid'=>$valid,'address'=>$address]]);
    }

    public function send(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fromAddress' => 'required',
            'toAddress' => 'required',
            'amount' => 'required|numeric|min:0.00000001'
        ]);

        $amount = $request->amount;
        $toAddress = $request->toAddress;
        $fromAddress = $request->fromAddress;

        if (!$validator->passes()){
            $data = array(
                'success' => false,
                'message' => $validator->errors()
            );
            return response()->json($data);
        }

        $is_valid = Wallet::where('address',$toAddress)->first();
        if(!$is_valid){
            $data = array(
                'success' => false,
                'message' => 'Address not found or invalid'
            );
            return response()->json($data);
        }

        $type = 'Internal';
        $code = Str::random(6);
        $wallet = 'Dinasty Coin';
        $trx_id = 'FNT-MYD'.time();
        $user_id = $is_valid->user_id;
        $description = 'Receive DC from Finetect';
        $walletAdmin = Wallet::where('user_id',1)->first()->address;
        $dcAdmin = Balance::where(['user_id'=>1,'description'=>$wallet])->first();
        $dcUser = Balance::where(['user_id'=>$user_id,'description'=>$wallet])->first();

        if($amount > $dcAdmin->balance){
            $data = array(
                'success' => false,
                'message' => 'Sender\'s balance is insufficient'
            );
            return response()->json($data);
        }

        Transaction::create([
            'user_id' => 1,
            'trx_id' => $trx_id,
            'from_address' => $walletAdmin,
            'to_address' => $toAddress,
            'amount' => $amount,
            'status' => 1,
            'type' => $type,
            'description' => $description,
            'code' => $code
        ]);

        // update wallet register pengirim
        $dcAdmin->balance = $dcAdmin->balance - $request->amount;
        $dcAdmin->save();

        HistoryTransaction::create([
            'balance_id'=>$dcAdmin->id,
            'from_id'=>1,
            'to_id'=>$user_id,
            'amount'=> $amount,
            'description'=> $description,
            'status'=> 1,
            'type'=> 'OUT'
        ]);

        $transaction = Transaction::create([
            'user_id' => $user_id,
            'trx_id' => $trx_id,
            'from_address' => $fromAddress,
            'to_address' => $toAddress,
            'amount' => $amount,
            'status' => 1,
            'type' => $type,
            'description' => $description,
            'code' => $code
        ]);

        // update wallet register penerima
        $dcUser->balance = $dcUser->balance + $amount;
        $dcUser->save();

        HistoryTransaction::create([
            'balance_id'=>$dcUser->id,
            'from_id'=> 1,
            'to_id'=> $user_id,
            'amount'=> $amount,
            'description'=> $description,
            'status'=> 1,
            'type'=> 'IN'
        ]);

        $collect = collect($transaction)->only(['trx_id', 'from_address', 'to_address', 'amount', 'status','created_at'])->all();
        $data = array(
            'success' => true,
            'message' => 'Success',
            'data' => $collect
        );
        return response()->json($data);
    }
}
