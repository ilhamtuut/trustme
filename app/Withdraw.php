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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
