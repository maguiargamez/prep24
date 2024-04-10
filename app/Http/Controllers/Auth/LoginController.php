<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
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
    //protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/dashboard/entidad';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    protected function authenticated(Request $request, $user)
    {
        return redirect('/dashboard/entidad');
        //Check user role, if it is not admin then logout
        /*$roles= $this->getCrmRoles();
        if(!$user->hasRole($roles))
        {
            $this->guard()->logout();
            $request->session()->invalidate();
            return redirect('/login')->withErrors('Usted no esta autorizado para logearse');
        }*/
    }

    private function getCrmRoles(){
        //return Role::select('name')->where('guard_name', 'crm')->get()->toArray();
        
    }

}
