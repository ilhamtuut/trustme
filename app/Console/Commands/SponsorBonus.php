<?php

namespace App\Console\Commands;

use App\Role;
use App\User;
use App\Price;
use App\Wallet;
use App\Balance;
use App\Program;
use App\Setting;
use App\Package;
use App\Downline;
use App\BonusPasif;
use App\Composition;
use App\BonusActive;
use App\LogActivity;
use App\LevelSponsor;
use App\BackupPassword;
use App\Transaction;
use App\HistoryTransaction;
use Illuminate\Console\Command;

class SponsorBonus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sponsor:go';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sponsor Bonus';

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
        $data = Program::whereDate('created_at','>=','2021-06-18')
                ->whereDate('created_at','<=','2021-06-21')->get();
        foreach($data as $value){
            $this->bonus_sponsor($value->user_id,$value->amount);
            echo "\n".$value->user_id;
        }
    }

    public function bonus_sponsor($user_id,$amount)
    {
        $uplines = Downline::whereNotIn('user_id',[1,2])->where('downline_id',$user_id)->limit(10)->get();
        foreach ($uplines as $key => $value) {
            $levelSponsor = ++$key;
            $upline_id = $value->user_id;
            $cek_program = Program::where(['user_id'=>$upline_id])
                    ->whereIn('status',[0,2])->orderBy('id','desc')->first();
            if($cek_program){
                // $percent = 0;
                // $nameLevel = '';
                $percentSponsor = LevelSponsor::where('id',$levelSponsor)->first();
                if($percentSponsor){
                    $percent = $percentSponsor->percent;
                    $nameLevel = $percentSponsor->name;
                    $composition = Composition::where('name','Bonus Active')->first();
                    $bonus = $amount * $percent;

                    $user = User::find($upline_id);
                    $max300 = $user->is_max($bonus);
                    if($max300['max_profit']){
                        $bonus = $max300['bonus'];
                        if($bonus > 0){
                            $lost = $max300['lost'];
                            BonusActive::create([
                                'user_id' => $upline_id,
                                'from_id' => $user_id,
                                'amount' => $amount,
                                'percent' => $percent,
                                'bonus' => $bonus,
                                'lost' => $lost,
                                'status' => 1,
                                'description' => 'Bonus Sponsor '.$nameLevel
                            ]);

                            $bonus_satu = $bonus * $composition->one;
                            if($bonus_satu > 0){
                                $wallet_a1 = Balance::where(['user_id' => 1, 'description' => 'USD Wallet'])->first();
                                $wallet_a1->balance = $wallet_a1->balance - $bonus_satu;
                                $wallet_a1->save();
                                $history = HistoryTransaction::create([
                                    'balance_id'=> $wallet_a1->id,
                                    'from_id'=> 1,
                                    'to_id'=> $upline_id,
                                    'amount'=> $bonus_satu,
                                    'description'=> 'Bonus Sponsor '.$nameLevel.' USD Wallet to '.ucfirst($user->username),
                                    'status'=> 1,
                                    'type'=> 'OUT'
                                ]);

                                $wallet_satu = $user->balance()->where('description','USD Wallet')->first();
                                $wallet_satu->balance = $wallet_satu->balance + $bonus_satu;
                                $wallet_satu->save();
                                $history = HistoryTransaction::create([
                                    'balance_id'=> $wallet_satu->id,
                                    'from_id'=> $user_id,
                                    'to_id'=> $upline_id,
                                    'amount'=> $bonus_satu,
                                    'description'=> 'Bonus Sponsor '.$nameLevel.' USD Wallet',
                                    'status'=> 1,
                                    'type'=> 'IN'
                                ]);
                            }
                        }
                    }
                }
            }
        }
    }
}
