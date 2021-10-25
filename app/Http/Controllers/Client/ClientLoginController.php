<?php

namespace App\Http\Controllers\Client;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Entities\Social; //sử dụng model Social
use App\Entities\User;
use App\Mail\SendMailToUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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
                'email' => $account_name->email,
                ]);

            $credentials = $request->only('email', 'password');
            $credentials['level'] = '2';

            if(Auth::guard('client')->attempt($credentials)){
                return redirect('/');
            };
            //dd(auth()->guard('client')->user());

            // Session::put('login',$account_name->name);
            // Session::put('id',$account_name->id);
            return redirect('/');
        }else{

            $facebook_login = new Social([
                'provider_user_id' => $provider->getId(),
                'provider' => 'facebook'
            ]);

            $orang = User::where('email',$provider->getEmail())->first();
            $temp_pass = Str::random(8);
            if(!$orang){
                $orang = User::create([
                    'name' => $provider->getName(),
                    'email' => $provider->getEmail(),
                    'password' => Hash::make($temp_pass),
                    'level' => 2
                ]);
            }
            $facebook_login->login()->associate($orang);
            $facebook_login->save();

            $account = Social::where('provider','facebook')->where('provider_user_id',$provider->getId())->first();
            $account_name = User::where('id',$account->user)->first();

            $credentials['email']=$account_name->email;
            $credentials['password']=$account_name->password;
            $credentials['level']='2';

            if(Auth::guard('client')->attempt($credentials)){
                $welcome = new \stdClass();
                $welcome->sender = 'HustStore';
                $welcome->pass = $temp_pass;
                $welcome->receiver = $account_name->name;
                Mail::to($account_name->email)->send(new SendMailToUser($welcome));
                return redirect('/');
            };

            return redirect('/')->with('status', 'Failed to Authenticate !');
        }
    }

    public function login(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:6',
        ]);

        $credentials = $request->only(['email','password']);
        $credentials['level'] = '2';

        if(Auth::guard('client')->attempt($credentials)){ //nếu ko có guard mặc định là web
            return redirect('/');
        } else {
            return back()->withInput(['email'])
                ->withErrors(['email' => 'Invalid credentials. ']);
        }

    }
    // protected function guard()
    // {
    //     return Auth::guard('client');
    // }

    // protected function credentials(Request $request)
    // {
    //     $credentials = $request->only($this->username(), 'password');
    //     dd($credentials);
    //     $credentials['level'] = '2';
    //     return $credentials;
    // }

    public function logout(){
        Auth::logout();
        return redirect('/');
    }


}
