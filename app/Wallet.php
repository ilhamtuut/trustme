<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'currency',
        'address',
    	'key',
    	'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
