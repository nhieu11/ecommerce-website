<?php

namespace App\Http\Controllers\Client;

use App\Entities\Order;
use App\Entities\OrderDetail;
use App\Entities\Product;
use App\Http\Controllers\Controller;
use App\Mail\SendMailToUser;
use Illuminate\Http\Request;
// use Darryldecode\Cart\Cart;
use Cart;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{
    // public $user = auth()->guard('client')->user();

    public function index()
    {
        return view('client.cart.index');
    }

    public function checkout()
    {
        $user = auth()->guard('client')->user();
        return view('client.cart.checkout',compact('user'));
    }

    public function complete(Request $request)
    {
        $user = auth()->guard('client')->user();
        $date_created = now();

        $order = new Order();
        $order->name = $user->name;
        $order->email = $user->email;
        $order->phone = $user->phone;
        $order->address = $user->address;
        $order->processed = 0;
        $order->created_at = now();
        $order->updated_at = now();
        $order->save();
        session()->flash('success','Tạo mới thành công');

        dd($order->id);

        $invoice = new \stdClass();
        $invoice->demo_one = 'Demo One Value';
        $invoice->demo_two = 'Demo Two Value';
        $invoice->sender = 'SenderUserName';
        $invoice->receiver = 'ReceiverUserName';

        Mail::to("bun2809@gmail.com")->send(new SendMailToUser($invoice));
        // $order_details = new OrderDetail();
        // // $order_details->order_id = $request->name;
        // $order_details->product_id = $request->parent_id;
        // $order_details->save();
        // $order_details = OrderDetail::create($input);
        return view('client.cart.complete',compact('user','date_created'));
    }

    public function add(Request $request)
    {
        // Cart::clear(); // Xóa toàn bộ giỏ hàng
        $request->validate([
            'product_id' => 'required',
            'name' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
        ]);

        $product = Product::findOrFail($request->product_id);

        Cart::add([
            'id' => $request->product_id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $request->quantity,
            'attributes' => [
                'sku' => $product->sku,
                'avatar' => $product->avatar
            ]
        ]);
        return response()->json([
            'cartTotalQuantity' => Cart::getTotalQuantity(),
        ], 200);
    }

    public function remove(Request $request)
    {
        $request->validate([
            'product_id' => 'required'
        ]);

        Cart::remove($request->product_id);

        return response()->json([], 204);
    }

    public function update(Request $request)
    {

        $request->validate([
            'product_id' => 'required',
            'quantity' => 'required|numeric',
        ]);

        Cart::update($request->product_id, [
            'quantity' => [
                'relative' => false,        //not + thêm , mà = value
                'value' => $request->quantity
            ]
        ]);

        return response()->json([
            'itemSubTotal' => number_format(Cart::get($request->product_id)->getPriceSum()), //numer_format : trả về chuỗi not số
            'total' => number_format(Cart::getTotal())
        ], 200); //200 trả về thêm 1 số detail
    }
}
