<?php

namespace App\Http\Controllers\Client;

use App\Entities\Order;
use App\Entities\OrderDetail;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {

        // $orders = Order::where('user_id', 1)->take(4)->get();
        // dd($orders);
        return view('client.user.index');
    }

    public function order()
    {
        $userID = (auth()->guard('client')->user()->id);
        $orders = Order::with('orderDetail')->where('user_id', $userID)->orderby('updated_at', 'desc')->get();
        return view('client.user.orders', compact('orders'));
    }

    public function trackingorder($orderID)
    {
        $order = Order::find($orderID); //tìm theo ID
        $date =  (int)$order->created_at->format('d') + 4;
        $orderDetail = OrderDetail::where('order_id', $orderID)->orderby('updated_at', 'desc')->get();
        return view('client.user.trackingorder', compact('order', 'orderDetail', 'date'));
    }
}