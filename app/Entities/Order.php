<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['shipper_id'];
    public function orderDetail(){
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }
    
    public function coupon(){
        return $this->belongsTo(Coupon::class, 'coupon_id', 'id');
    }

    public function shipper(){
        return $this->belongsTo(Shipper::class, 'shipper_id', 'id');
    }
}