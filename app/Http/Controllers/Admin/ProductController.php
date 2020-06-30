<?php

namespace App\Http\Controllers\Admin;

use App\Entities\Product;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        // DB::table('products') //truy vấn cả db

        $products = Product::with('category')->get(); //Lấy ra dssp, with() = category()->first(), $product trả về 1 mảng mà Product ở Entities sử dụng hàm category
        return view('admin.products.index',[
            'products' => $products
        ]);
    }

    public function create(){
        return view('admin.products.create');
    }

    public function store(Request $request){
        $request->validate([
            'category_id' => 'required',
            'sku' => 'required|unique:products',
            'name' => 'required',
            'price' =>'required|numeric|min:0',
            'img' => 'sometimes|image',
        ], [
            'sku.required' => 'Thiếu mã sản phẩm'
        ]);
        $input = $request->only([
            'category_id',
            'sku',
            'name',
            'price',
            'quantity',
            'featured',
            'detail',
            'description',
        ]);

            if ($request->hasFile('img')){
                $imgName=uniqid('vietpro_k88'). '.' . $request->img->getClientOriginalExtension();  //Đổi tên unique cho ảnh để không trùng ,getClientOriginalExtension : lấy ra phần đuôi (tên file mở rộng)
                $destinationDir = public_path('/files/images/products'); //Directory , public_path : Trả tới địa chỉ đang có trên pc (hardaddress)
                $request->img->move($destinationDir,$imgName);  //move($Location,$filesName), $Location: Là thư mục chứa file upload lên Sever, $filesName: Là tên mới của file.
                $input['avatar'] = asset("/files/images/products/{$imgName}"); //asset trả tới địa chỉ đường dẫn trên server(browser) (softaddress)
            }

            //.gitignore ignore mọi thứ (.) thư mục trừ file .gitigore
            // print_r($request ->all());
            $product = Product::create($input);
            return redirect("/admin/products/{$product->id}/edit");
        // print_r($request->all());die;
    }
    public function edit($product){
        //public function edit(Product $product){
        $product = Product::findOrFail($product);
        //if (!$product) abort(404);
        return view('admin.products.edit', compact('product'));
      //<=>
      //return view('admin.products.edit',['product' => $product]);
    }
    public function update(UpdateProductRequest $request, $product){
        $input = $request->only([
            'category_id',
            'sku',
            'name',
            'price',
            'img',
            'featured',
            'detail',
            'description',
        ]);
        $product = Product::findOrFail($product);
        $product->fill($input);
        $product->save();
        return back();
    }
    public function destroy($product){
        $deleted = Product::destroy($product);  //Trả về 1,2,3 nếu tìm thấy 1,2,3 bản ghi ngược lại là 0
        if ($deleted){
            return response()->json([], 204); //204 No Content: Server đã xử lý thành công request nhưng không trả về bất cứ content nào.
        }
        return response()->json(['message'=>'Sản phẩm cần xóa không tồn tại.'], 404); //404 Not Found: Các tài nguyên hiện tại không được tìm thấy nhưng có thể có trong tương lai. Các request tiếp theo của Client được chấp nhận.
    }

    private function getSubCategories($parentId, $ignoreId =null)
    {
        $categories = Category::whereParentId($parentId)
        ->where('id','<>', $ignoreId)
        ->get();
        $categories->map(function($category) use($ignoreId){ // Đệ quy dừng khi $categories = NULL , map : lặp tất cả trong cate tìm đến sub của nó
            $category->sub = $this->getSubCategories($category->id, $ignoreId); // Tìm parentId, gọi $ignoreId vào đệ quy
            // print_r($categories->toArray());
            return $category;
        });
        return $categories;
    }

}

