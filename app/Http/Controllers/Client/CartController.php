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

use function GuzzleHttp\Promise\all;

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

    public function postCheckout(Request $request){
        // dd($request);
        $user = auth()->guard('client')->user();

        $order = new Order();
        $order->name = $request->name;
        $order->email = $request->email;
        $order->phone = $request->phone;
        $order->address = $request->address;
        $order->processed = 0;
        $order->created_at = now();
        $order->updated_at = now();
        $order->save();

        foreach (Cart::getContent() as $item) {
            $orderDetail = new OrderDetail();
            $orderDetail->order_id = $order->id;
            $orderDetail->product_id = $item->id;
            $orderDetail->sku = $item->attributes['sku'];
            $orderDetail->name = $item->name;
            $orderDetail->price = $item->price;
            $orderDetail->quantity = $item->quantity;
            $orderDetail->avatar = $item->attributes['avatar'];
            $orderDetail->save();
        }

        // Cart::clear();

        $date_created = now();
        $infoOrder = Order::findOrFail($order->id)->orderDetail;
        // foreach($infoOrder as $item){
        //     dd($item->name);
        // }

        $invoice = new \stdClass();
        $invoice->sender = 'HustStore';
        $invoice->name = $infoOrder;
        $invoice->receiver = $request->name;

        Mail::to("bun2809@gmail.com")->send(new SendMailToUser($invoice));
        return view('client.cart.complete',compact('user','date_created'));

        return redirect('/complete');
    }

    public function complete()
    {
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
