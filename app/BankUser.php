<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankUser extends Model
{
    protected $fillable = [
        'user_id',
        'bank_id',
        'account',
        'username',
    	'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class, 'bank_id');
    }
}
