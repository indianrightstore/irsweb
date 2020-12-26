<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'name','state_id','city_country_id','latitude','longitude','pincode','status',
    ];
}
