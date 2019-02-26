<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\User;

class AuthController extends Controller
{

    public function register(Request $request){
        $data = $request->all();

        $this->validate($request, [
            'name'=>'required',
            'email'=>'required|unique:users,email',
            'password'=>'required|confirmed'
        ]);

        $credentials = array(
                'email' => $data['email'],
                'password' => $data['password']
            );

        User::create([
            'email' => $data['email'],
            'name' => $data['name'],
            'password' => bcrypt($data['password'])
            ]);

        return $this->login($credentials);

    }

    public function logout(){
        Auth::logout();
        return redirect()->intended('/login');
    }

    public function login($credential){

        if (Auth::attempt($credential, 1)) {
            return redirect()->intended('/todo');
        } else {
            return redirect('/login')->with('notification', 'Kindly check credential');
        }
    }

    public function authenticate(Request $request)
    {

        $credential = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        return $this->login($credential);
        
    }
}
