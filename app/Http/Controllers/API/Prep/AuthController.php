<?php

namespace App\Http\Controllers\API\Prep;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Ranger\LoginRequest;
use Illuminate\Http\Request;

use App\Http\Traits\ApiResponser;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRanger;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use ApiResponser;

    public function login(LoginRequest $request)
    {
        //$attr = $request->all();
        $username= $request->input('username');
        $password= $request->input('password');
        if(
            Auth::attempt(['email' => $username, 'password' => $password]) ||
            Auth::attempt(['celular' => $username, 'password' => $password]) 
        ){
            $roles= $this->getRoles();
            $user= User::find(auth()->user()->id);
            if(!$user->hasRole($roles))
            {
                //$this->guard()->logout();
                //$request->session()->invalidate();
                //auth()->user()->tokens()->delete();
                return [
                    'message' => 'Sesión cerrada, no tiene los privilegios requeridos'
                ];
            }    
            return $this->success([
                'token' => auth()->user()->createToken('API Token')->plainTextToken
            ], 'Sesión iniciada');
        }else{
            return $this->error('No se encontraron las credenciale de acceso', 401);
        }



    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return $this->success(
            null, 'Sesión cerrada'
        );
    }

    private function getRoles(){
        //return Role::select('name')->where('guard_name', 'guardabosques')->get()->toArray();  
        return ["prep"];      
    }
}
