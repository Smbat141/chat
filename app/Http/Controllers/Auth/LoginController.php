<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }



    public function redirectToProvider($service){
        return Socialite::driver($service)->redirect();
    }

    public function handleProviderCallback($service){
    if ($service == 'google'){
        $socialUser = Socialite::driver($service)->stateless()->user();
    }
    else{
        $socialUser = Socialite::driver($service)->user();

    }


       $user = User::where('service_id',$socialUser->getId())->first();
        if(!$user){
            User::create([
                'service_id' => $socialUser->getId(),
                'name' => $socialUser->getName(),
                'email' => $socialUser->getEmail(),
            ]);
        }

        auth()->login($user);
        return redirect()->to('/');
    }



}