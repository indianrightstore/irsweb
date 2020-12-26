<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StoreProductMapping extends Model
{
 
    protected $fillable = [
        'store_id','product_id'
    ];
}
