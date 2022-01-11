<?php

namespace App\Console\Commands;

use App\User;
use App\HoldTmc;
use App\Setting;
use App\Balance;
use App\HistoryTransaction;
use Illuminate\Console\Command;

class BackTmc extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'back:tmc';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $description = 'Trustme Coin Balance Reduction';
        $data = HoldTmc::where('status',1)->get();
        foreach ($data as $key => $value) {
            $amount = $value->amount;
            $user = $value->user;

            $cash = $user->balance()->where('description',$type_wallet)->first();
            $cash->balance = $cash->balance - $amount;
            $cash->save();

            HistoryTransaction::create([
                'balance_id' => $cash->id,
                'from_id' => 1,
                'to_id' => $user->id,
                'amount' => $amount,
                'description' => $description,
                'status' => 1,
                'type' => 'OUT'
            ]);
            // Admin
            $admin = Balance::where(['user_id'=> 1,'description'=> $type_wallet])->first();
            $admin->balance = $admin->balance + $amount;
            $admin->save();

            HistoryTransaction::create([
                'balance_id' => $admin->id,
                'from_id' => 1,
                'to_id' => $user->id,
                'amount' => $amount,
                'description' => $description.' From '.ucfirst($user->username),
                'status' => 1,
                'type' => 'IN'
            ]);

            $value->status = 0;
            $value->save();
        }
    }
}
