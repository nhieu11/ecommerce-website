<?php

namespace App\Http\Controllers\Client;

use App\Entities\Product;
use App\Entities\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Admin\CategoryController;

class ProductController extends Controller
{

    public function index(Request $request){
        if($request->start != null) {
            $products = Product::whereBetween('price',[$request->start, $request->end])->paginate();
        }else if($request->color != null){
            $products = Product::where('color',$request->color)->paginate();
        }else if($request->brand != null){
            $products = Product::where('brand',$request->brand)->paginate();
        }
        else{
            $products = Product::paginate(6);
        }

        $categories = Category::get(); //get không dùng dc relationship
        $parent = 0;
        return view('client.product.index',compact('products','categories','parent'));
    }

    public function categorize_byID($id){
        $categories = Category::get();
        $parent = 0;
        $products=Category::where('id',$id)->first()->products()->paginate(6);
        return view('client.product.index',compact('categories','parent','products'));
    }

    public function detail($product){
        $product = Product::findOrFail($product);
        $data['prd_new']=Product::orderby('created_at',"DESC")->take(4)->get();
        return view('client.product.detail',$data,compact('product'));
    }
}
