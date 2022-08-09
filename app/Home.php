<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    protected $table = 'products';

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
