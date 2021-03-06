<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    public $timestamps = false;
    public function order(){
            return $this->belongsTo(Order::class, 'order_id', 'id');
    }
}
