<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RetailersPurchaseDataMapping extends Model
{
    protected $fillable = [
        'retailer_id','category_id','brand_id','product_id','product_quantity','product_mrp','discount','pv','bv','store_id','total_ammount',
    ];
}
