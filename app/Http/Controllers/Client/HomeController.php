<?php

namespace App\Http\Controllers\Client;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use Illuminate\Http\Request;
use App\Entities\Product;

class HomeController extends Controller
{
    public function index(){
        $data['prd_fe']=Product::where('featured',1)->take(4)->get();
        $data['prd_new']=Product::orderby('created_at',"DESC")->take(8)->get();
        return view('client.home.index',$data);
    }
    public function about(){
        return view('client.home.about');
    }
    public function contact(){
        return view('client.home.contact');
    }
    public function store(CreateUserRequest $request){
        dd($input = $request->only([
            'email',
            'name',
            'address',
            'phone',
        ]));
        $input['level'] = '4';
        $input['password'] = bcrypt("$request->password");
        User::create($input);
        return redirect("/login");
    }
}
