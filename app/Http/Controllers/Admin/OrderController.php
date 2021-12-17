<?php

namespace App\Http\Controllers\Admin;

use App\Entities\Order;
use App\Entities\OrderDetail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
       $orders = Order::with('orderDetail')->where('processed',0)->orderby('id','desc')->paginate(5);//Chờ duyệt (phân công ship ở đây)

        return view('admin.orders.index',compact('orders'));
    }
    public function processed(){
        $orders = Order::with('orderDetail')->where('processed',1)->orderby('updated_at','desc')->paginate(5);//Đã duyệt(phân công shipper xong, có hiển thị thông tin shipper)
        return view('admin.orders.processed',compact('orders'));
    }
    public function delivery(){
        $orders = Order::with('orderDetail')->where('processed',2)->orderby('updated_at','desc')->paginate(5);//Đang giao hàng(bàn giao hàng,in bản kê cho shipper)
        return view('admin.orders.delivery',compact('orders'));
    }
    public function complete(){
        $orders = Order::with('orderDetail')->where('processed',3)->orderby('updated_at','desc')->paginate(5);//Hoàn thành
        return view('admin.orders.complete',compact('orders'));
    }
    public function detail($order_id){
        $order = Order::Find($order_id);
        return view('admin.orders.detail',compact('order'));
    }
    public function update($order_id){
        $order = Order::find($order_id);
        $order->processed = 1;
        $order->save();
        return redirect('/admin/orders/processed');
    }
}
