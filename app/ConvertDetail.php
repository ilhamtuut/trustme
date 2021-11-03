<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConvertDetail extends Model
{
    protected $fillable = [
    	'convert_id',
        'total',
        'price',
        'receive'
    ];

    public function convert()
    {
        return $this->belongsTo(Convert::class, 'convert_id');
    }
}
