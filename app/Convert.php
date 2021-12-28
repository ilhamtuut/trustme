<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Convert extends Model
{
    protected $fillable = [
        'invoice',
        'user_id',
        'amount',
        'fee',
        'total',
        'price',
        'receive',
        'trustme',
        'spartan',
        'receive',
        'status',
    	'description'
    ];

    // protected $appends = ['detail_receive'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function detail()
    {
        return $this->hasMany(ConvertDetail::class, 'convert_id');
    }

    // public function getDetailReceiveAttribute()
    // {
    //     $total = $this->detail()->sum('receive');
    //     return $total;
    // }
}
