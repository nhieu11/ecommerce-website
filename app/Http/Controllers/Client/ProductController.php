<?php

namespace App\Http\Controllers\Client;

use App\Entities\Product;
use App\Entities\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Admin\CategoryController;

class ProductController extends Controller
{

    public function index(){
        $products = Product::paginate(); //mỗi trang có 5
        $categories = Category::get();
        $parent = 0;
        return view('client.product.index',compact('products','categories','parent'));
    }

    public function detail($category , $product){
        // $product = Product::whereSlug($product)->findOrFail(); //Khi đi làm dùng slug abc-xyz-fgh
        $product = Product::findOrFail($product);
        return view('client.product.detail');
    }
}
