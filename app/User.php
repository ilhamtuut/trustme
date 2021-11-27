<?php

namespace App;
use Mail;
use App\Program;
use App\Downline;
use App\BackupPassword;
use Illuminate\Notifications\Notifiable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, EntrustUserTrait;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent_id',
        'name',
        'username',
        'phone_number',
        'email',
        'foto',
        'status',
        'is_verified',
        'is_online',
        'verification_token',
        'session_id',
        'password',
        'trx_password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'is_verified' => 'boolean',
    ];

    protected $appends = ['direct'];

    public function generateVerificationToken()
    {
        $token = $this->verification_token;
        if (!$token) {
            $token = str_random(40);
            $this->verification_token = $token;
            $this->save();
        }
        return $token;
    }

    public function sendVerification()
    {
        $token = $this->generateVerificationToken();
        $user = $this;
        Mail::send('mail.verification', compact('user', 'token'), function ($m) use ($user) {
            $m->to($user->email, $user->name)->subject('Verification Account');
        });
    }

    public function verify()
    {
        $this->is_verified = 1;
        $this->verification_token = null;
        $this->save();

        $user = $this;
        $pass = BackupPassword::where('user_id',$user->id)->first();
        Mail::send('mail.information_password', compact('user','pass'), function ($m) use ($user) {
            $m->to($user->email, $user->name)->subject('Information Account');
        });
    }

    public function program()
    {
        return $this->hasMany(Program::class, 'user_id');
    }

    public function childs()
    {
        return $this->hasMany(User::class, 'parent_id');
    }

    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }

    public function bonus_active()
    {
        return $this->hasMany(BonusActive::class, 'user_id');
    }

    public function bonus_pasif()
    {
        return $this->hasMany(BonusPasif::class, 'user_id');
    }

    public function withdraw()
    {
        return $this->hasMany(Withdraw::class, 'user_id');
    }

    public function balance()
    {
        return $this->hasMany(Balance::class, 'user_id');
    }

    public function convert()
    {
        return $this->hasMany(Convert::class, 'user_id');
    }

    public function mybank()
    {
        return $this->hasMany(BankUser::class, 'user_id');
    }

    public function wallet()
    {
        return $this->hasOne(Wallet::class, 'user_id');
    }

    public function is_max($bonus)
    {
        $max_profit = $this->program()->sum('max_profit');
        $active = $this->bonus_active()->sum('bonus');
        $pasif = $this->bonus_pasif()->sum('bonus');
        $total_bonus = $active + $pasif;
        $currentBonus = $total_bonus + $bonus;
        $lost = 0;
        if($currentBonus > $max_profit){
            $kurang = $max_profit - $total_bonus;
            $lost = $bonus - $kurang;
            $bonus = $kurang;
        }
        $data = array(
            'max_profit' => ($total_bonus < $max_profit) ? true : false,
            'bonus' => $bonus,
            'lost' => $lost,
        );
        return $data;
    }

    public function show_msg()
    {
        $max_profit = $this->program()->sum('amount') * 3;
        $active = $this->bonus_active()->sum('bonus');
        $pasif = $this->bonus_pasif()->sum('bonus');
        $total_bonus = $active + $pasif;
        return ($total_bonus > 0 && $total_bonus >= $max_profit) ? true : false;
    }

    public function downlines()
    {
        return $this->hasMany(Downline::class, 'user_id');
    }

    public function getDirectAttribute(){
        $downlines = $this->downlines()->pluck('downline_id')->toArray();
        $plan = $this->program()->where('registered_by','!=',0)->sum('amount');
        $total = Program::whereIn('user_id',$downlines)->where('registered_by','!=',0)->sum('amount');
        $direct = $total + $plan;
        return $direct;
    }

    public function omset(){
        $downlines = $this->downlines()->pluck('downline_id')->toArray();
        $total = Program::whereIn('user_id',$downlines)->where('registered_by','!=',0)->sum('amount');
        return $total;
    }

    public function position_week()
    {
        $arry = $this->childs()->has('program')->get();
        $feet = [];
        foreach ($arry as $key => $value) {
            array_push($feet, $value->direct);
        }
        rsort($feet, SORT_NUMERIC);
        $top3 = array_slice($feet, 0, 3);
        $feet1 = 0;
        $feet2 = 0;
        $feet3 = 0;
        if(count($top3) == 2){
            $feet1 = $top3[0];
            $feet2 = $top3[1];
        }else if(count($top3) == 3){
            $feet1 = $top3[0];
            $feet2 = $top3[1];
            $feet3 = $top3[2];
        }
        $position = 'Empty';
        return $position;
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'user_id')->where('type','!=','Need Eth');
    }

    public function deposit()
    {
        return $this->hasMany(Deposit::class, 'user_id');
    }
}
