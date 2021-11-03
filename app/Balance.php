<?php

namespace App;

use App\Setting;
use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    protected $fillable = [
        'user_id',
        'balance',
    	'status',
    	'description'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function history()
    {
        return $this->hasMany(HistoryTransaction::class, 'balance_id');
    }

    public function getBalanceAttribute()
    {
        $isShow = false;
        $saldo = $this->attributes['balance'];
        if($isShow && $this->attributes['description'] == 'Trustme Coin'){
            $saldo = 0;
        }
        return $saldo;
    }
}
