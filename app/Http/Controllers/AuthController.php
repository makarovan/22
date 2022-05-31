<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class AuthController extends Controller
{
   public function login(){
        return view('start');
   } 

   //проверка формы логин
   public function authenticate(Request $request){
        $request->validate([
            'email'=>'required|string|email',
            'password'=>'required|string',
        ]);
        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials)){
            //return redirect('dashboard');
            return redirect('/');
        }
        return redirect('login')->with('error', 'Oops, wrong login or password');
   }
   //logout
   public function logout(){
        Auth::logout();
        return redirect('/');
   }
}
