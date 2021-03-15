<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request) {
        return view('web.login');

    }
    public function logincheck(Request $request) {
        $this->validate($request,[
            'email'=> 'required',
            'password'=> 'required'
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'role' => 'student'])) {
            //echo "Hello";
            return redirect()->route('web.home')->with('success', 'You are successfully logged in!');
        }
        else {
            return redirect()->route('web.login')->with('error', 'Invalid Cridential');
        }
    }

    public function logout(Request $request){
        Auth::logout();
        return redirect('web/login');
    }
}
