<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = ['order_id','product_id','quantity','sku','name','price','avatar'];


    public $timestamps = false;
    public function order(){
            return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function shipper(){
        return $this->belongsTo(Shipper::class, 'shipper_id', 'id');
    }
}
