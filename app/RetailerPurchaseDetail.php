<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RetailerPurchaseDetail extends Model
{
    protected $fillable = [
        'order_id','store_id',
    ];
}
