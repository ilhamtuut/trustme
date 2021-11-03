<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $fillable = [
        'user_id',
        'package_id',
        'amount',
        'harvest',
        'register',
        'max_profit',
        'status',
        'registered_by',
    	'description'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }

    public function byreg()
    {
        return $this->belongsTo(User::class, 'registered_by');
    }

    public function bonus()
    {
        return $this->hasMany(BonusPasif::class, 'program_id');
    }
}
