<?php

namespace CookieSoftCommerce;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'featured',
        'recommend'
    ];

    public function images(){
        return $this->hasMany('CookieSoftCommerce\ProductImage');
    }

    public function category()
    {
       return $this->belongsTo('CookieSoftCommerce\Category','category_id');
    }


}
