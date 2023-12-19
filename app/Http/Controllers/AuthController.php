<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function loginPage(){
        return view('auth.login');
    }

    public function registerPage(){
        Auth::logout();
        return view('auth.register');
    }

    public function roleCheck(){
        if(Auth::user()->role == 'admin'){
            return redirect()->route('admin#home');
        }else{
            return redirect()->route('home');
        }
    }
}
