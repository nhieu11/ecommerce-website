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

    protected function guard()
    {
        return Auth::guard('client');

    }




}
