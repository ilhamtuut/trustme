<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HoldTmc extends Model
{
    protected $fillable = [
        'user_id',
        'invoice',
        'amount',
        'rate',
        'total',
        'expired_at',
        'status',
    	'description'
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            try {
                $model->invoice = self::generateInvoice();
            } catch (UnsatisfiedDependencyException $e) {
                abort(500, $e->getMessage());
            }
        });
    }

    public static function generateInvoice()
    {
        $string = 'HLD'.date('y').date('m');
        $format = $string.'000000';
        $latest = self::orderBy('id','desc')->first();
        if($latest){
            $format = $latest->invoice;
        }
        $id = substr($format, -6);
        $newID = intval($id) + 1;
        $newID = str_pad($newID, 6, '0', STR_PAD_LEFT);
        return $string.$newID;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
