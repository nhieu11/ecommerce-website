<?php

namespace App\Http\Controllers\Client;

use App\Entities\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Requests\CreateUserRequest;

class ClientLoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function showLoginForm()
    {
        return view('client.auth.login');
    }

    public function showRegisterForm()
    {
        return view('client.auth.register');
    }

    // protected function credentials(Request $request)
    // {
    //     return $credentials = $request->only($this->username(), 'password');
    //     $credentials['type'] = 'client';
    //     return $credentials;
    // }

    // public function login(Request $request){
    //     $request->validate([
    //         'email'=>'required|email',
    //         'password'=>'required|min:6',
    //     ]);

    //     $credentials = $request->only(['email','password']);
    //     // dd($credentials);
    //     if(Auth::guard('client')->attempt($credentials)){ //nếu ko có guard mặc định là web
    //         return redirect('/');
    //     } else {
    //         return back()->withInput(['email'])
    //             ->withErrors(['email' => 'Email hoặc password đã nhập sai!']);
    //     }

    // }

    public function create(CreateUserRequest $request)
    {
       $input = $request->only([
            'email',
            'name',
            'address',
            'phone',
        ]);
        $input['level'] = '4';
        $input['password'] = bcrypt("$request->password");
        User::create($input);
        return redirect("/login");
    }

    protected function guard()
    {
        return Auth::guard('client');
    }

    protected function credentials(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:6',
        ]);

        $credentials = $request->only($this->username(), 'password');
        $credentials['level'] = '4';
        return $credentials;
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
