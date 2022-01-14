<?php

namespace App\Http\Controllers\Admin;

use App\Entities\Shipper;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateShipperRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
// use Illuminate\Auth\Access\Gate;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class ShipperController extends Controller
{
    public function index(Shipper $shipper){
        // $client = new Client();
        // $res = $client->request('GET', 'https://api.github.com/users/nhieu11');
        // $content = json_decode($res->getBody()->getContents());
        // foreach($content as $key => $value) {
        //     echo "{$key}: {$value}" . PHP_EOL;
        //     echo "<br>";
        // }
        // debugbar()->info($content);
        // $users = DB::table('users')->whereName('Hieu')->update([
        //     'created_at' => now(),
        //     'updated_at' => now(),
        //     'email' => 'abcd@gmail.com',
        //     'name' => 'Hieu Bui',
        // ]);
        //$users = DB::table('users')->select(['id','name','email','address'])
        // $users = User::select(['id','name','email','address'])
        // ->get();
        // ->where('email','=','%o@mail.com%')
        //->whereId('2')
        //->whereName('abc')
        //->whereEmailVerifieldAt('abc')
        //->where('id','>','2') // = > < >= <= <> like
        //->limit(2)->offset(1) // bỏ qua
        //=
        //->skip(1)->take(2)
        //->get(); //lấy ra dạng mảng
        //->first(); //lấy ra chính xác 1 cái
        // print_r($users);
        // DB::table('users')->insert([
        //     'name'=>'Boss',
        //     'email'=>'boss@mail.com',
        //     'password'=>'123123123',
        // ]);
        // $users = DB::table('users')->where('email','=','boss@mail.com')->first();
        // print_r($users);
        // die;

       /*  if (! Gate::allows('read-user')) {
            abort(403);
        } */



            $shippers = Shipper::get(); //roles vẫn là hàm ở Entities/User.php , lưu trên RAM, tốn bộ nhớ không tốn thời gian query

        debugbar()->info($shippers);

        return view('admin.shippers.index',[
            'shippers' => $shippers
        ]);
    }
    

    public function create(){
        return view('admin.shippers.create');
    }
    public function store(UpdateShipperRequest $request){
        $input = $request->only([
            'name',
            'phone',
            'email',
            'address',
        ]);
        $shipper = Shipper::create($input);
        return redirect("/admin/shippers/{$shipper->id}/edit");
    }
    public function edit($shipper){ // User $user ?
        $shipper = Shipper::findOrFail($shipper);
        return view('admin.shippers.edit',compact('shipper'));
    }
    public function update(UpdateShipperRequest $request, $shipper){
        $input = $request->only([
            'email',
            'name',
            'address',
            'phone',
        ]);

        $shipper = Shipper::findOrFail($shipper);
        $shipper->fill($input);
        // print_r($user)
        $shipper->save();
        return back();
    }

    public function destroy($shipper){
        $deleted = Shipper::destroy($shipper);
        if($deleted){
            return response()->json([], 204);
        }
        return response()->json(['message'=>'Shipper cần xóa không tồn tại.'], 404);
    }

}
