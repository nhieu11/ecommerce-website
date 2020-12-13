<?php

namespace App\Http\Controllers\Client;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Entities\Social; //sử dụng model Social
use App\Entities\User;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite; //sử dụng Socialite
use Illuminate\Support\Str;


class ClientLoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function showLoginForm(){
        return view('client.auth.login');
    }

    public function login_facebook(){
        return Socialite::driver('facebook')->redirect();
    }

    public function callback_facebook(Request $request){
        $provider = Socialite::driver('facebook')->user();
        $account = Social::where('provider','facebook')->where('provider_user_id',$provider->getId())->first();
        if($account){
            //login in
            $account_name = User::where('id',$account->user)->first();
            $request->merge([
                'password' => $account_name->password,
                'name' => $account_name->name,
                ]);

            $credentials = $request->only('name', 'password');
            $credentials['level'] = '2';

            Auth::guard('client')->attempt($credentials);

            if(auth('client')){

                dd(auth()->guard('client')->user());
            }

            // Session::put('login',$account_name->name);
            // Session::put('id',$account_name->id);
            return redirect('/');
        }else{

            $facebook_login = new Social([
                'provider_user_id' => $provider->getId(),
                'provider' => 'facebook'
            ]);

            $orang = User::where('email',$provider->getEmail())->first();

            if(!$orang){
                $orang = User::create([
                    'name' => $provider->getName(),
                    'email' => $provider->getEmail(),
                    'password' => '',
                    'level' => 2
                ]);
            }
            $facebook_login->login()->associate($orang);
            $facebook_login->save();
            sleep(500);
            dd($account);
            $account_name = User::where('id',$account->user)->first();

            Session::put('login',$account_name->name);
            Session::put('id',$account_name->id);
            dd("asd");
            return redirect('/');
        }
    }


    protected function guard()
    {
        return Auth::guard('client');
    }

    protected function credentials(Request $request)
    {
        $credentials = $request->only($this->username(), 'password');
        $credentials['level'] = '2';
        return $credentials;
    }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }


}
