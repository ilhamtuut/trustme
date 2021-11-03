<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BonusPasif extends Model
{
    protected $fillable = [
        'user_id',
        'program_id',
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

    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }
}
