<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Composition extends Model
{
    protected $fillable = [
        'name',
        'one',
        'two',
        'three'
    ];
}
