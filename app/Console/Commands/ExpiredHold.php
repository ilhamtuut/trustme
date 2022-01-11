<?php

namespace App\Console\Commands;

use App\User;
use App\HoldTmc;
use App\Setting;
use App\Balance;
use App\HistoryTransaction;
use Illuminate\Console\Command;

class ExpiredHold extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expired:hold';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Expired Hold';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $date = date('Y-m-d');
        $type_wallet = 'Trustme Coin';
        $description = 'Back Hold Bounty';
        $data = HoldTmc::where('status',0)->whereDate('expired_at','<',$date)->get();
        foreach ($data as $key => $value) {
            $amount = $value->amount;
            $user = $value->user;
            $expired_at = $value->expired_at;
            if($date > $expired_at){
                // Admin
                $admin = Balance::where(['user_id'=> 1,'description'=> $type_wallet])->first();
                $admin->balance = $admin->balance - $amount;
                $admin->save();

                HistoryTransaction::create([
                    'balance_id' => $admin->id,
                    'from_id' => 1,
                    'to_id' => $user->id,
                    'amount' => $amount,
                    'description' => $description.' To '.ucfirst($user->username),
                    'status' => 1,
                    'type' => 'OUT'
                ]);

                $cash = $user->balance()->where('description',$type_wallet)->first();
                $cash->balance = $cash->balance + $amount;
                $cash->save();

                HistoryTransaction::create([
                    'balance_id' => $cash->id,
                    'from_id' => 1,
                    'to_id' => $user->id,
                    'amount' => $amount,
                    'description' => $description,
                    'status' => 1,
                    'type' => 'IN'
                ]);

                $value->status = 1;
                $value->save();
            }
        }

    }
}
