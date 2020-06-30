<?php

namespace App\Http\Controllers\Client;

use App\Entities\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $products = Product::paginate(); //mỗi trang có 5
        return view('client.product.index',compact('products'));
    }

    public function detail($category , $product){
        // $product = Product::whereSlug($product)->findOrFail(); //Khi đi làm dùng slug abc-xyz-fgh
        $product = Product::findOrFail($product);
        return view('client.product.detail');
    }
}
