<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    protected $fillable = [
        'unique_id','name','email','contact','country_id','state_id','city_id','manufacturer_location','file_name','store_category_id'
    ];
}
