<?php

namespace App\Http\Controllers\Admin;

use App\Entities\Order;
use App\Entities\OrderDetail;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateOrderRequest;

use Admin\ShipperController;
use App\Entities\Shipper;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('orderDetail')->where('processed', 0)->orderby('id', 'desc')->paginate(5); //Chờ duyệt (phân công ship ở đây)

        return view('admin.orders.index', compact('orders'));
    }
    public function processed()
    {
        $orders = Order::with('orderDetail')->where('processed', 1)->orderby('updated_at', 'desc')->paginate(5); //Đã duyệt(phân công shipper xong, có hiển thị thông tin shipper,in bản kê,có nút chuyển trạng thái đang giao hàng)
        return view('admin.orders.processed', compact('orders'));
    }
    public function delivery()
    {
        $orders = Order::with('orderDetail')->where('processed', 2)->orderby('updated_at', 'desc')->paginate(5); //Đang giao hàng(bàn giao hàng và 1 bản kê cho shipper, có nút hoàn thành -> tự động cộng tiền và doanh thu)
        return view('admin.orders.delivery', compact('orders'));
    }
    public function finished()
    {
        $orders = Order::with('orderDetail')->where('processed', 3)->orderby('updated_at', 'desc')->paginate(5); //Hoàn thành(Thu tiền từ shipper)
        return view('admin.orders.finished', compact('orders'));
    }
    public function detail($order){
        $order = Order::Find($order);
        $shippers = Shipper::get();

        return view('admin.orders.detail',compact('order','shippers'));


    }

    public function update(UpdateOrderRequest $request, $order) {
        $input = $request->only([
            'shipper_id',
        ]);
        $order = Order::findOrFail($order);
        $order->fill($input);
        $order->processed += 1;
        $order->save();
        return redirect("/admin/orders/processed");



    }
    public function deliveryDetail($order_id)
    {
        $order = Order::Find($order_id);
        return view('admin.orders.deliveryDetail', compact('order'));
    }
    public function finishedDetail($order_id)
    {
        $order = Order::Find($order_id);
        return view('admin.orders.finishedDetail', compact('order'));
    }
    public function complete($order_id)
    {
        $order = Order::find($order_id);
        $order->processed = 3;
        $order->dateCollection = Carbon::now();
        $order->save();
        return redirect('/admin/orders/finished');
    }
}
