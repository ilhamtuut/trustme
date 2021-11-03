<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = [
        'name',
        'amount',
        'percent',
        'max_profit',
    	'status',
    	'description'
    ];
}
