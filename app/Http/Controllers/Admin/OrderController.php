<?php

namespace App\Http\Controllers\Admin;

use App\Entities\Order;
use App\Entities\OrderDetail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
       $orders = Order::with('orderDetail')->paginate(5);

        return view('admin.orders.index',compact('orders'));
    }
    public function processed(){
        return view('admin.orders.processed');
    }
    public function edit(){
        return view('admin.orders.edit');
    }
    public function update(){

    }
}
