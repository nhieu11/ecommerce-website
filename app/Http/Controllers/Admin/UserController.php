<?php

namespace App\Http\Controllers\Admin;
use App\Entities\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\CreateUserRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
// use Illuminate\Auth\Access\Gate;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index(User $user){
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

        if (!$this->userCan('read-user')) {
            abort('403', __('Bạn không có quyền thực hiện thao tác này'));
        }

            $users = User::with('roles')->get(); //roles vẫn là hàm ở Entities/User.php , lưu trên RAM, tốn bộ nhớ không tốn thời gian query

        debugbar()->info($users);

        return view('admin.users.index',[
            'users' => $users
        ]);
    }
    public function create(){
        return view('admin.users.create');
    }
    public function store(CreateUserRequest $request){

       $input = $request->only([
            'email',
            'name',
            'address',
            'phone',
            'level',
        ]);
        $input['password'] = bcrypt("$request->password");
        $user = User::create($input);
        return redirect("/admin/users/{$user->id}/edit");
    }
    public function edit($user){ // User $user ?
        $user = User::findOrFail($user);
        return view('admin.users.edit',compact('user'));
    }
    public function update(UpdateUserRequest $request, $user){
        $input = $request->only([
            'email',
            'name',
            'address',
            'phone',
        ]);
        $input['password'] = bcrypt("$request->password");
        $user = User::findOrFail($user);
        $user->fill($input);
        // print_r($user)
        $user->save();
        return back();
    }

    public function destroy($user){
        $deleted = User::destroy($user);
        if($deleted){
            return response()->json([], 204);
        }
        return response()->json(['message'=>'Sản phẩm cần xóa không tồn tại.'], 404);
    }

    public function userCan($action, $option = NULL){
    $user = Auth::user();
    return Gate::forUser($user)->allows($action, $option);
        }

}
