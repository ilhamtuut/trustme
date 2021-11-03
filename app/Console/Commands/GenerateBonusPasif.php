<?php

namespace App\Console\Commands;

use DB;
use App\User;
use App\Balance;
use App\Program;
use App\Setting;
use App\BonusPasif;
use App\BonusActive;
use App\LogGenerate;
use App\HistoryTransaction;
use Illuminate\Console\Command;

class GenerateBonusPasif extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:bonus_pasif';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Commission Pasif';

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
        $datenow = date('Y-m-d');
        $description = 'Bonus Daily';
        $data = Program::whereNotIn('user_id',[1,2])
            ->whereIn('status',[0])
            ->whereDate('created_at','!=',$datenow)
            ->get();
        if(count($data) > 0){
            LogGenerate::create([
                'activity'=>'Generate Bonus Pasif Start',
                'status'=>1
            ]);
            foreach ($data as $key => $value) {
                echo ++$key." - \n";
                $id = $value->id;
                $user_id = $value->user_id;
                $amount = $value->amount;
                $percent = $value->package->percent;
                $bonus = $amount * $percent;
                $max_profit = Program::where('id','<=',$id)->where('user_id',$user_id)->sum('max_profit');
                $active = $value->user->bonus_active()->sum('bonus');
                $pasif = $value->user->bonus_pasif()->sum('bonus');
                $currentBonus = $active + $pasif;
                $total_bonus = $currentBonus + $bonus;
                $running = true;
                if($total_bonus > $max_profit){
                    $bonus = $max_profit - $currentBonus;
                    if($bonus < 0){
                        $running = false;
                    }
                }
                if($running){
                    // maximum 300%
                    $max300 = $value->user->is_max($bonus);
                    if($max300['max_profit']){
                        $bonus = $max300['bonus'];
                        $lost = $max300['lost'];
                        $check = BonusPasif::where(['program_id'=>$id,'user_id'=>$user_id,'description'=>$description])->whereDate('created_at',$datenow)->first();
                        if(is_null($check)){
                            BonusPasif::create([
                                'user_id' => $user_id,
                                'program_id' => $id,
                                'amount' => $amount,
                                'percent' => $percent,
                                'bonus' => $bonus,
                                'lost' => $lost,
                                'status' => 1,
                                'description' => $description
                            ]);

                            $admin = Balance::where(['user_id' => 1,'description'=>'USD Wallet'])->first();
                            $admin->balance = $admin->balance - $bonus;
                            $admin->save();

                            HistoryTransaction::create([
                                'balance_id'=> $admin->id,
                                'from_id'=> 1,
                                'to_id'=> $user_id,
                                'amount'=> $bonus,
                                'description'=> $description.' USD Wallet To '.ucfirst($value->user->username),
                                'status'=> 1,
                                'type'=> 'OUT'
                            ]);

                            $usd = $value->user->balance()->where('description','USD Wallet')->first();
                            $usd->balance = $usd->balance + $bonus;
                            $usd->save();

                            HistoryTransaction::create([
                                'balance_id'=> $usd->id,
                                'from_id'=> 1,
                                'to_id'=> $user_id,
                                'amount'=> $bonus,
                                'description'=> $description.' USD Wallet',
                                'status'=> 1,
                                'type'=> 'IN'
                            ]);
                        }
                    }
                }else{
                    $value->status = 1;
                    $value->save();
                }
            }
            LogGenerate::create([
                'activity'=>'Generate Bonus Pasif End',
                'status'=>1
            ]);
        }else{
            LogGenerate::create([
                'activity'=>'Generate Bonus Pasif Data Not Found',
                'status'=>1
            ]);
        }
        echo "Selesai\n";
    }
}
