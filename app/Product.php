<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function image()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }
    public function categorie()
    {
        return $this->belongsTo(ProductCategorie::class, 'categorie_id');
    }
}
