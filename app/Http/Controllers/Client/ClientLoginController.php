<?php

namespace App\Http\Controllers\Client;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class ClientLoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function showLoginForm(){
        return view('client.auth.login');
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

    protected function guard()
    {
        return Auth::guard('client');
    }

    protected function credentials(Request $request)
    {
        $credentials = $request->only($this->username(), 'password');
        $credentials['level'] = '4';
        return $credentials;
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }


}
