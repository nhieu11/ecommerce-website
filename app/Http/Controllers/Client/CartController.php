<?php

namespace App\Http\Controllers\Client;

use App\Entities\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Darryldecode\Cart\Cart;
use Cart;

class CartController extends Controller
{
    public function index()
    {
        return view('client.cart.index');
    }

    public function checkout()
    {
        return view('client.cart.checkout');
    }

    public function complete()
    {
        return view('client.cart.complete');
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
