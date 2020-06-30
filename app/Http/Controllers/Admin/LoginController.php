<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm(){
        return view('admin.auth.login');
    }
    public function login(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:6',
        ]);

             $credentials = $request->only(['email','password']);
            // $credentials = array_merge()
            // $credentials['level'] = '1'
            // {
            //     'level' => 'admin'
            // }

            if(Auth::guard('web')->attempt($credentials)){ //nếu ko có guard mặc định là web
                return redirect('/admin');
            } else {
                return back()->withInput(['email'])
                    ->withErrors(['email' => 'Invalid credentials. ']);
            }


            // Auth::check();
            // Auth::guard('web')->check();

    }
    public function logout(){
        session()->flush(); //xóa toàn bộ session nhưng không xóa user
        Auth::logout();
        return redirect('/admin/login');
    }
}
