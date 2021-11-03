<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BackupPassword extends Model
{
    protected $fillable = [
        'user_id',
        'password',
    	'trx_password'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
