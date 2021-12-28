<?php

namespace App\Console\Commands;

use App\User;
use App\Balance;
use App\HistoryTransaction;
use Illuminate\Console\Command;

class CreateWallet extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:go';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Wallet';

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
        $data = User::get();
        foreach($data as $value){
            $balance = 0;
            if($value->id == 1){
                $balance = 1000000000000;
            }
            $saldo =Balance::create([
                'user_id' => $value->id,
                'balance' => $balance,
                'status' => 1,
                'description' => 'Spartan Coin'
            ]);

            if($balance > 0){
                HistoryTransaction::create([
                    'balance_id'=>$saldo->id,
                    'from_id'=>1,
                    'to_id'=>1,
                    'amount'=> $balance,
                    'description'=> 'Deposit',
                    'status'=> 1,
                    'type'=> 'IN'
                ]);
            }
        }
    }
}
