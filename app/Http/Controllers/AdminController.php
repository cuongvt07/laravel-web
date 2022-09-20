<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Symfony\Component\VarDumper\Caster\RedisCaster;

class AdminController extends Controller
{
    //
    public function loginAdmin()
    {
        if(auth()->check()){
            return redirect()->to('home');
        }
        return view('login');
    }

    public function postloginAdmin(Request $request)
    {
        $remember= $request->has('remember-me') ? true :false;
        if (auth()->attempt([
            'email' => $request->email,
            'password' => $request->password

        ],$remember)) {
            return redirect()->to('home');
        }
    }
    public function logoutAdmin(Request $request){
        $request->session()->forget('email');
        $request->session()->forget('password');
        return view('login');
    }
}
