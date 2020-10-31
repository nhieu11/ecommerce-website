<?php

namespace App\Http\Controllers\Admin;

use App\Entities\Order;
use App\Entities\OrderDetail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
       $orders = Order::with('orderDetail')->where('processed',0)->orderby('id','desc')->paginate(5);

        return view('admin.orders.index',compact('orders'));
    }
    public function processed(){
        $orders = Order::with('orderDetail')->where('processed',1)->orderby('updated_at','desc')->paginate(5);
        return view('admin.orders.processed',compact('orders'));
    }
    public function detail($order_id){
        $order = Order::Find($order_id);
        return view('admin.orders.detail',compact('order'));
    }
    public function update(){

    }
}
