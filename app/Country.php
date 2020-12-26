<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'name','country_code','latitude','longitude','currency_code_id','status',
    ];
}
