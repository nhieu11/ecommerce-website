<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Shipper extends Model
{
    public function order(){
        return $this->hasMany(Orders::class, 'shipper_id', 'id');
    }

    public function orderDetail(){
        return $this->hasManyThrough(OrderDetail::class, Orders::class);
    }
}
