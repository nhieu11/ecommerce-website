<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = ['id'];  //danh sách đen

    public function products(){
        return $this->hasMany(Product::class, 'category_id', 'id'); //Tham chiếu so sánh các khóa
    }
}
