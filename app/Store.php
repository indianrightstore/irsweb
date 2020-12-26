<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $fillable = [
        'name','email','number','store_location','product_id','file_name','store_category_id'
    ];
}
