<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';
    protected $fillable = [
        'order_id',
        'user_id',
        'product_id',
        'total_price',
        'bank',
        'no_rekening',
        'tujuan_rekening',
        'nama_rekening',
        'tanggal_transfer',
        'bukti_transfer',
    ];

    public function order()
    {
        return $this->hasMany(Order::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }

    // Get Image 
    public function getTakeImageAttribute()
    {
        return "/storage/" . $this->bukti_transfer;
    }
}
