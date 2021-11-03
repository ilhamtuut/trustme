<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'trx_id',
        'from_address',
        'to_address',
        'amount',
        'fee',
        'receive',
        'status',
        'type',
    	'description',
        'json',
        'code'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
