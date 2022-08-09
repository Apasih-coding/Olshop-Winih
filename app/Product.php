<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'image', 'image2', 'image3', 'name_product',
        'slug', 'category_id', 'total', 'price_buy', 'price_sell', 'desc'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }

    // Get Image 
    public function getTakeImageAttribute()
    {
        return "/storage/" . $this->image;
    }
    public function getTakeImage2Attribute()
    {
        return "/storage/" . $this->image2;
    }
    public function getTakeImage3Attribute()
    {
        return "/storage/" . $this->image3;
    }
}
