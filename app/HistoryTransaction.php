<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoryTransaction extends Model
{
    protected $fillable = [
        'balance_id',
        'from_id',
        'to_id',
        'amount',
    	'description',
    	'status',
    	'type'
    ];

    public function from()
    {
        return $this->belongsTo(User::class, 'from_id');
    }

    public function to()
    {
        return $this->belongsTo(User::class, 'to_id');
    }
}
