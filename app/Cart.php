<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'image',
        'name_product',
        'total',
        'price'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }

    public function counts()
    {
        $data = Cart::all();
        return collect($data)->count();
    }
}
