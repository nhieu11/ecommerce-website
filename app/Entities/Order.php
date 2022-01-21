<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function orderDetail(){
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }

    public function shipper(){
        return $this->belongsTo(Shipper::class, 'shipper_id', 'id');
    }
}
