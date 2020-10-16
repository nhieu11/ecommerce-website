<?php

namespace App\Http\Controllers\Admin;

use App\Entities\Category;
use App\Entities\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index(Request $request){
        // $categories = DB::table('categories')->select(['name','parent_id'])
        // ->get();
        // debugbar()->info($categories);

        // if ($request->wantsJson()) {  //API
        //     $client = new \GuzzleHttp\Client();
        //     $res = $client->request('GET', 'https://api.github.com/users/nhieu11');
        //     return response()->json([
        //         'name' => json_decode($res->getBody()->getContents())
        //     ]);
        // }


        $categories = $this->getSubCategories(0); // Bắt thằng gốc
        // dd($categories);
        //  foreach ($categories as $category ) {
        //      $category->sub = Category::whereParentId($category->id)->get();
        //  }
        //  print_r($categories->toArray());die;
        return view('admin.categories.index',[
            'categories' => $categories
        ]);


    }

    public function getSubCategories($parentId, $ignoreId =null)
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

    public function create(){
        $categories = $this->getSubCategories(0);
        return view('admin.categories.create', compact('categories'));
    }

    public function store(Request $request){
        $request->validate([
            'parent_id' => 'required',
            'name' => 'required',
        ]);
        $category = new Category();
        $category->name = $request->name;
        $category->parent_id = $request->parent_id;
        $category->save();
        session()->flash('success','Tạo mới thành công');
        return redirect('/admin/categories');
    }
    public function edit($id){ //Bắt id trên uri
        $category = Category::findOrFail($id); //Model Category , biến lưu bản ghi

        $category->products()->get(); //Trả về 1 query builder
        Product::where('category_id', $category);

        $categories = $this->getSubCategories(0, $id); //Tại view edit, biến lưu kết quả đệ quy, con trỏ $this tham chiếu
        return view('admin.categories.edit', compact('category', 'categories')); //compact truyền về view
    }
    public function update(Request $request, Category $category){
        // $request->validate([
        //     'parent_id'
        // ])
    $category->fill($request->only(['parent_id', 'name'])); //gom tất cả những thứ đưa từ view lên
    $category->save();

    // return back()->with('success','Category Updated.');
    return redirect('/admin/categories')->with('success','Cập nhật thành công');
    }
    public function destroy($category){
        $deleted = Category::destroy($category);
        if($deleted){
            return respone()->json([], 204);
        }
        return response()->json(['message'=>'Sản phẩm cần xóa không tồn tại.'], 404);
    }
}
