<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;

class HomeController extends Controller
{
    public function index() {
        if(Auth::user())
        {
            $student_detail = Student::with('course')->where('user_id',Auth::user()->id)->first();
            return view('web.home',compact('student_detail'));
        }
        else{
            return view('web.login');
        }
    }

}
