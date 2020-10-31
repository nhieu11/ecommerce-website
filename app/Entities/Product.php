<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // protected $fillable = [    //danh sách trắng
    //     'name',
    //     'sku',
    //     'category_id',
    //     'price',
    //     'quantity',
    // ];

    protected $guarded = ['id'];   //danh sách đen

    protected $perPage = 5; //lấy ra 5

    public function category() //Hàm này 1 query builder s/d ở index
    {
        return $this->belongsTo(Category::class, 'category_id', 'id'); //Cùng cấp Category, thư mục khác phải viết namespace, nếu để mặc định thì không cần truyền vào para như 'category_id'
    } //Quy ước tên bảng số nhiều, tên cột số ít _


    public function orderDetail(){
        return $this->hasMany(OrderDetail::class, 'product_id', 'id');
    }
}

