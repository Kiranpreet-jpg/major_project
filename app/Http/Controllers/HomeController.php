<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Course;
use App\Models\Notes;
use App\Models\Student;
use App\Models\Batch;
use App\Models\Teacher;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $assignment = Assignment::with('course','subject')->get();
        $note = Notes::with('course','subject')->get();
        $course_count = Course::count();
        $batch_count = Batch::count();
        $teacher_count = Teacher::count();
        $student_count = Student::count();
        return view("home", compact('assignment', 'note','course_count','batch_count','teacher_count','student_count'));
    }
}
