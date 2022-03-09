<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    protected $fillable = [
        'invoice',
        'user_id',
        'amount',
        'price',
        'total',
        'fee',
        'receive',
        'status',
        'type',
    	'description',
        'json',
    ];

    public function getDescriptionAttribute(){
        $setData = '2022-03-02';
        $date = date('Y-m-d', strtotime($this->attributes['created_at']));
        if($date >= $setData && $this->attributes['description'] == 'Withdrawal Spartan Coin'){
            return 'Withdrawal CAPRABULLCOIN';
        }
        return $this->attributes['description'];
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
