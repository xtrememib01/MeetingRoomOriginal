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
            //for testing purpose only when not in the ongc network
        
            if($request->cpf='121757'){
                $localUser = User::where('cpf', $request->cpf)->first();
                Auth::login($localUser);
                return true;
            }

            $ldapUser = Adldap::search()->where('sAMAccountName', $request->cpf)->firstOrFail();
    
            if($ldapUser){
                $this->saveUserData( $request);
            }
            $userDn = $ldapUser->distinguishedname[0];
            $localUser = User::where('cpf', $request->cpf)->first();
            
            if(Adldap::auth()->attempt($userDn, $request->password)) {
                Auth::login($localUser);
                return true;
            }
        // }
            return false;
        
    }

    public function saveUserData(Request $request ){
        $AdldapUser = Adldap::search()->where('sAMAccountName', $request->cpf)->firstOrFail();
    
        $user = User::where('cpf', $request->cpf)->first();
        /*Adding the number to the local database
        $user->update(['Phone' => $AdldapUser->mobile[0]]); Output ->09968282814
        Wheres for sending the SMS, mobile number has to be 9968282814
        */

        if(!$user){
            $usr= New User();
            $usr->name= $AdldapUser->mail[0];
            $usr->email= $AdldapUser->mail[0];
            $usr->cpf= $request->cpf;
            $usr->location = 'not required';
            $usr->password = bcrypt($request->password);
            $usr->Phone = substr($AdldapUser->mobile[0],1);
            $usr->save();
        }
        else{
            $user->update(['Phone' => substr($AdldapUser->mobile[0],1)]);
            $user->update(['email' => $AdldapUser->mail[0]]);
            $user->save();
        }    
    }
}
