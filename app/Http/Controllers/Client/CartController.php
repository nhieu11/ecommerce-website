<?php

namespace App\Http\Controllers\Client;

use App\Entities\Order;
use App\Entities\OrderDetail;
use App\Entities\Product;
use App\Entities\Coupon;
use App\Http\Controllers\Controller;
use App\Mail\SendMailToUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
// use Darryldecode\Cart\Cart;
use Cart;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session as FacadesSession;

session_start();

use function GuzzleHttp\Promise\all;

class CartController extends Controller
{
    // public $user = auth()->guard('client')->user();

    public function index()
    {
        return view('client.cart.index');
    }

    public function checkout(Request $request)
    {
        $user = auth()->guard('client')->user();
        if (Session::get('coupon')) {
            foreach (Session::get('coupon') as $key => $cou) {
                if ($cou['coupon_condition'] == 1) {
                    $total_coupon = (Cart::getTotal() * $cou['coupon_number']) / 100;
                    $bill = Cart::getTotal() - $total_coupon;
                } elseif ($cou['coupon_condition'] == 2) {
                    $total_coupon = Cart::getTotal() - $cou['coupon_number'];
                    $bill = $total_coupon;
                }
            }
        } else {
            $bill = Cart::getTotal();
        }
        return view('client.cart.checkout', compact('user', 'bill'));
    }

    public function unset_coupon()
    {
        $coupon = Session::get('coupon');
        if ($coupon == true) {

            Session::forget('coupon');
            return redirect()->back()->with('message', 'Xóa mã khuyến mãi thành công');
        }
    }

    public function check_coupon(Request $request)
    {
        $data = $request->all();
        $coupon = Coupon::where('coupon_code', $data['coupon'])->first();
        if ($coupon) {
            $count_coupon = $coupon->count();
            if ($count_coupon > 0) {
                $coupon_session = Session::get('coupon');
                if ($coupon_session == true) {
                    $is_avaiable = 0;
                    if ($is_avaiable == 0) {
                        $cou[] = array(
                            'coupon_code' => $coupon->coupon_code,
                            'coupon_condition' => $coupon->coupon_condition,
                            'coupon_number' => $coupon->coupon_number,

                        );
                        Session::put('coupon', $cou);
                    }
                } else {
                    $cou[] = array(
                        'coupon_code' => $coupon->coupon_code,
                        'coupon_condition' => $coupon->coupon_condition,
                        'coupon_number' => $coupon->coupon_number,

                    );
                    Session::put('coupon', $cou);
                }
                Session::save();
                return redirect()->back()->with('message', 'Thêm mã giảm giá thành công');
            }
        } else {
            return redirect()->back()->with('error', 'Mã giảm giá không đúng');
        }
    }
    public function postCheckout(Request $request)
    {

        $order = new Order();
        $order->name = $request->name;
        $order->email = $request->email;
        $order->phone = $request->phone;
        $order->address = $request->address;
        $order->total = $request->bill;
        $order->processed = 0;
        $order->user_id = Auth::id();
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

        Cart::clear();

        $date_created = now();
        $infoOrder = Order::findOrFail($order->id);

        $invoice = new \stdClass();
        $invoice->sender = 'HustStore';
        $invoice->name = $infoOrder->orderDetail;
        $invoice->receiver = $request->name;

        Mail::to("bun2809@gmail.com")->send(new SendMailToUser($invoice));
        return view('client.cart.complete', compact('infoOrder', 'date_created'));

        return redirect('/complete');
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
        return back()->with('cartTotalQuantity', Cart::getTotalQuantity());
    }

    public function remove(Request $request)
    {
        $request->validate([
            'product_id' => 'required'
        ]);

        Cart::remove($request->product_id);

        return response()->json([], 204);
    }

    public function removeAll()
    {
        Cart::clear();
        return view("client.cart.index");
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