<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Downline extends Model
{
    protected $fillable = [
        'user_id',
        'downline_id',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function downline()
    {
        return $this->belongsTo(User::class, 'downline_id');
    }
}
