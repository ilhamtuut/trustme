<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LevelSponsor extends Model
{
    protected $fillable = [
        'name',
        'percent',
        'old_omset',
        'new_omset',
    	'status'
    ];
}
