<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $fillable = [
        'amount',
        'sold',
        'rest',
        'price',
        'status'
    ]; 
}
