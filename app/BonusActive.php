<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BonusActive extends Model
{
    protected $fillable = [
        'user_id',
        'from_id',
        'amount',
        'percent',
        'bonus',
        'lost',
    	'status',
    	'description'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function from()
    {
        return $this->belongsTo(User::class, 'from_id');
    }
}
