<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function register(REQUEST $request ){
        $fillingData=$request ->validate([
            'name'  =>(['required','min:1',Rule::unique('users','name')]),    
            'email' =>(['required',Rule::unique('users','email')]),
            'password' =>('required')

        ]);

        $user=User::create($fillingData);
        auth()->login($user);
        return redirect('/');

    }

    public function logout(){
        auth()->logout();
        return redirect('/');
    }

    public function login(Request $request){
        $fillingData=$request->validate([
            'loginname' => ('required'),
            'loginpassword'=>('required')
        ]);

        if (auth()->attempt(['name'=>$fillingData['loginname'],'password'=>$fillingData['loginpassword']])){
            $request->session()->regenerate();
        }
        return redirect('/');
    }
}
