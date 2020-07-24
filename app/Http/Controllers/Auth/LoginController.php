<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use App\User;

use Illuminate\Http\Request;
use Adldap\Laravel\Facades\Adldap;
use Illuminate\Support\Facades\Auth;



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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
 
    }

    

    public function username(){
        return 'cpf';
    }

    public function attemptLogin(Request $request) {
        
        $ldapUser = Adldap::search()->where('sAMAccountName', $request->cpf)->firstOrFail();
        $userDn = $ldapUser->distinguishedname[0];

        // // iterates through all the users to check if the user exists
        // $users = User::all();
        // foreach ($users as $user) {
        //     if (User::where('cpf',$request->cpf)->firstOrFail() == $user->cpf)
        //     //do something and then break
        //     break;
        // }
        

        if(Adldap::auth()->attempt($userDn, $request->password)) {
            $localUser = User::where('cpf', $request->cpf)->firstOrFail();
            Auth::login($localUser);
            return true;
        }
            return false;
    }
}
