<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\AttendanceCount;
use App\Models\Batch;
use App\Models\Course;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Student as GlobalStudent;

class AttendanceController extends Controller
{
    public function viewAttendance() {
        $user = Auth::user();
        if ($user) {
            $student_detail = Student::with('course')->where('user_id',Auth::user()->id)->first();
            $student = Student::where('user_id', $user->id)->first();
            $subject = Subject::where('course_id', $student->course_id)->get();

           return view('web.attendance.index',compact('subject','student_detail'));
         }
         else {
            return view('web.login');
        }
    }

    public function showAttendanceAsPerSubject($id) {
        $user = Auth::user();
        if ($user) {
            $student_detail = Student::with('course')->where('user_id',Auth::user()->id)->first();
            $student = Student::where('user_id', $user->id)->first();

            // header('content-type:text/javascript');
            // echo json_encode($student,JSON_PRETTY_PRINT);

            $attendance = Attendance::where('subject_id', $id)->where('course_id', $student->course_id)->where('batch_id', $student->batch_id)->get();

            $attendanceCount = AttendanceCount::with('subject')->where('subject_id', $id)->where('roll_number', $student->roll_number)->first();

            $new_attend = array();
            $final_attend1 = array();
            $final_attend = array();

            $final_attend1['subject'] = $attendanceCount->subject->name;

            $final_attend1['total_lecture'] = $attendanceCount->total_lecture;

            $final_attend1['attended_lecture'] = $attendanceCount->attended;

            for($i=0;$i<count($attendance);$i++)
            {
                $new_attend['attendance_date'] = $attendance[$i]->attendance_date;
                $new_attend['attendance'] = json_decode($attendance[$i]->attendance,true);
                $new_attend['day_attendance'] = $new_attend['attendance'][$student->roll_number];
                $final_attend['attendance_array'][] = $new_attend;
            }

            // header('Content-type:text/javascript');
            // echo json_encode($final_attend,JSON_PRETTY_PRINT);
            // die();
            return view ('web.attendance.show', compact('final_attend1','final_attend','student_detail'));
         } else {
            return view('web.login');
        }

    }
}
