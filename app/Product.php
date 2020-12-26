<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name','price','market_price','brand_id','manufacturer_id','discount',
    ];
}
