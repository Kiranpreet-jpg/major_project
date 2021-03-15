<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Batch;
use App\Models\Subject;
use App\Models\Course;
use App\Models\AssignTeacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\AttendanceCount;

class AttendanceController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:view-attendance', ['only' => ['index']]);
        $this->middleware('permission:mark-attendance', ['only' => ['create','store']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if ($user) {
            $assign_batch = AssignTeacher::where('teacher_user_id', $user->id)->get();

            $assign_course = array();
            for ($i = 0; $i < count($assign_batch); $i++) {
                $batch = Batch::where('id', $assign_batch[$i]->batch_id)->first();
                $assign_course[] = $batch->course_id;
            }

            $course = array();
            for ($j = 0; $j < count($assign_course); $j++) {

                $courses = Course::where('id', $assign_course)->first();
                $course[] = $courses;
            }

            return view('attendance.index', compact('course'));
        } else {
            return view('Auth.login');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = Auth::user();
        if ($user) {
            $assign_batch = AssignTeacher::where('teacher_user_id', $user->id)->get();

            $assign_course = array();
            for ($i = 0; $i < count($assign_batch); $i++) {
                $batch = Batch::where('id', $assign_batch[$i]->batch_id)->first();
                $assign_course[] = $batch->course_id;
            }

            $course = array();
            for ($j = 0; $j < count($assign_course); $j++) {

                $courses = Course::where('id', $assign_course)->first();
                $course[] = $courses;
            }

            return view('attendance.create', compact('course'));
        } else {
            return view('Auth.login');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rollno_count = count($request->rollno);
        if($request->attend){
            $present_student_count = count($request->attend);
        }
        else{
            $present_student_count = 0;
        }

        if($rollno_count == $present_student_count)
        {
            //All students are present
            $attend_det = array();

            for ($i = 0; $i < count($request->attend); $i++) {
                $new_roll = explode(':', $request->attend[$i]);
                $get_rollno = $new_roll[0]; //present rollno
                $get_att = $new_roll[1]; //present

                // echo $get_rollno."=".$get_att."<br>";

                /**** all present rollnos*****/
                $all_rollno[] = $get_rollno;
                $attend_det[] = $request->attend[$i];
            }

            //attandance json
            foreach($attend_det as $ad)
            {
                $ad1 = explode(':',$ad);
                $ad2[$ad1[0]] = $ad1[1];
                $attendance_json = json_encode($ad2);
            }
            // echo "all are present ".$attendance_json;

            // if attendance already exists
            if (Attendance::where('course_id', $request->course_id)->where('batch_id', $request->batch_id)->where('subject_id', $request->subject_id)->where('attendance_date', $request->attendance_date)->exists()) {

                $get_old_attendance_record = Attendance::where('course_id', $request->course_id)->where('batch_id', $request->batch_id)->where('subject_id', $request->subject_id)->where('attendance_date', $request->attendance_date)->first();

                $get_old_attendance = json_decode($get_old_attendance_record->attendance,true);
                foreach($get_old_attendance as $key=>$value)
                {
                    if($value=="present")
                    {
                        //get_old_count of present student
                        $old_attend = AttendanceCount::where('roll_number',$key)->where('subject_id',$request->subject_id)->first();

                        //minus -1 from present student attendance count
                        AttendanceCount::where('roll_number',$key)->where('subject_id',$request->subject_id)->update([
                            'attended'=>$old_attend->attended-1,
                        ]);
                    }
                    //get_old_count of present student after deduction
                    $old_attend1 = AttendanceCount::where('roll_number',$key)->where('subject_id',$request->subject_id)->first();

                    //add 1 to present student attendance count
                    AttendanceCount::where('roll_number',$key)->where('subject_id',$request->subject_id)->update([
                        'attended'=>$old_attend1->attended+1,
                    ]);

                }
                Attendance::where('course_id', $request->course_id)->where('batch_id', $request->batch_id)->where('subject_id', $request->subject_id)->where('attendance_date', $request->attendance_date)->update([
                    'attendance' => $attendance_json
                ]);

                return redirect()->route('attendance.create')->with('success','Attendance updated');

            } else {

                //check if student exist in attendance count
                foreach($request->rollno as $key)
                {
                    if(AttendanceCount::where('roll_number',$key)->where('subject_id',$request->subject_id)->exists())
                    {
                        $old_attend = AttendanceCount::where('roll_number',$key)->where('subject_id',$request->subject_id)->first();

                        AttendanceCount::where('roll_number',$key)->where('subject_id',$request->subject_id)->update([
                            'total_lecture'=>$old_attend->total_lecture+1,
                            'attended'=>$old_attend->attended+1,
                        ]);
                    }
                    else{
                        //Add to attendance count
                        AttendanceCount::create([
                            'roll_number'=>$key,
                            'total_lecture'=>1,
                            'attended'=>1,
                            'subject_id'=>$request->subject_id
                        ]);
                    }
                }
                //Mark New day attendance
                Attendance::create([
                    'course_id' => $request->course_id,
                    'batch_id' => $request->batch_id,
                    'subject_id' => $request->subject_id,
                    'attendance_date' => $request->attendance_date,
                    'attendance' => $attendance_json
                ]);

                return redirect()->route('attendance.create')->with('success','Attendance Marked');
            }
        }
        else if($present_student_count==0){
            //all students are absent
            $attend_det = array();

            //merge rollno and absentees
            for ($ab = 0; $ab < count($request->rollno); $ab++) {
                $attend_det[] = $request->rollno[$ab] . ":absent";
            }

            // $all_attendence = json_encode($attend_det);

            //attandance json
            foreach($attend_det as $ad)
            {
                $ad1 = explode(':',$ad);
                $ad2[$ad1[0]] = $ad1[1];
                $attendance_json = json_encode($ad2);
            }

            // echo "all are absent ".$attendance_json;

            // if attendance already exists
            if (Attendance::where('course_id', $request->course_id)->where('batch_id', $request->batch_id)->where('subject_id', $request->subject_id)->where('attendance_date', $request->attendance_date)->exists()) {
                $get_old_attendance_record = Attendance::where('course_id', $request->course_id)->where('batch_id', $request->batch_id)->where('subject_id', $request->subject_id)->where('attendance_date', $request->attendance_date)->first();

                $get_old_attendance = json_decode($get_old_attendance_record->attendance,true);

                foreach($get_old_attendance as $key=>$value)
                {
                    if($value=="present")
                    {
                        //get_old_count of present student
                        $old_attend = AttendanceCount::where('roll_number',$key)->where('subject_id',$request->subject_id)->first();

                        //minus -1 from present student attendance count
                        AttendanceCount::where('roll_number',$key)->where('subject_id',$request->subject_id)->update([
                            'attended'=>$old_attend->attended-1,
                        ]);

                    }


                }

                Attendance::where('course_id', $request->course_id)->where('batch_id', $request->batch_id)->where('subject_id', $request->subject_id)->where('attendance_date', $request->attendance_date)->update([
                    'attendance' => $attendance_json
                ]);

                return redirect()->route('attendance.create')->with('success','Attendance updated');

            } else {

                //check if student exist in attendance count
                foreach($request->rollno as $key)
                {
                    if(AttendanceCount::where('roll_number',$key)->where('subject_id',$request->subject_id)->exists())
                    {
                        $old_attend = AttendanceCount::where('roll_number',$key)->where('subject_id',$request->subject_id)->first();

                        AttendanceCount::where('roll_number',$key)->where('subject_id',$request->subject_id)->update([
                            'total_lecture'=>$old_attend->total_lecture+1,
                        ]);
                    }
                    else{
                        //Add to attendance count
                        AttendanceCount::create([
                            'roll_number'=>$key,
                            'total_lecture'=>1,
                            'attended'=>0,
                            'subject_id'=>$request->subject_id
                        ]);
                    }
                }
                //Mark New day attendance
                Attendance::create([
                    'course_id' => $request->course_id,
                    'batch_id' => $request->batch_id,
                    'subject_id' => $request->subject_id,
                    'attendance_date' => $request->attendance_date,
                    'attendance' => $attendance_json
                ]);

                return redirect()->route('attendance.create')->with('success','Attendance Marked');
            }
        }
        else{
            // print_r($request->all());
            //mixed
            $attend_det = array();

            for ($i = 0; $i < count($request->attend); $i++) {
                $new_roll = explode(':', $request->attend[$i]);
                $get_rollno = $new_roll[0]; //present rollno
                $get_att = $new_roll[1]; //present

                // echo $get_rollno."=".$get_att."<br>";

                /**** all present rollnos*****/
                $all_rollno[] = $get_rollno;
                $attend_det[] = $request->attend[$i];
            }

            //List of absent students
            $absent = array_diff($request->rollno, $all_rollno);

            //traverse Absent student list
            foreach ($absent as $absent1) {
                $absents[] = $absent1;
            }

            //merge rollno and absentees
            for ($ab = 0; $ab < count($absents); $ab++) {
                $attend_det[] = $absents[$ab] . ":absent";
            }

            //attandance json
            foreach($attend_det as $ad)
            {
                $ad1 = explode(':',$ad);
                $ad2[$ad1[0]] = $ad1[1];
                $attendance_json = json_encode($ad2);
            }

            // echo "Mixed".$attendance_json;

            // if attendance already exists
            if (Attendance::where('course_id', $request->course_id)->where('batch_id', $request->batch_id)->where('subject_id', $request->subject_id)->where('attendance_date', $request->attendance_date)->exists()) {
                $get_old_attendance_record = Attendance::where('course_id', $request->course_id)->where('batch_id', $request->batch_id)->where('subject_id', $request->subject_id)->where('attendance_date', $request->attendance_date)->first();

                $get_old_attendance = json_decode($get_old_attendance_record->attendance,true);

                foreach($get_old_attendance as $key=>$value)
                {
                    if($value=="present")
                    {
                        //get_old_count of present student
                        $old_attend = AttendanceCount::where('roll_number',$key)->where('subject_id',$request->subject_id)->first();

                        //minus -1 from present student attendance count
                        AttendanceCount::where('roll_number',$key)->where('subject_id',$request->subject_id)->update([
                            'attended'=>$old_attend->attended-1,
                        ]);

                    }
                }

                for($rn=0;$rn<count($request->rollno);$rn++)
                {
                    // echo "<br>".$request->rollno[$rn]."<br>";
                    if(in_array($request->rollno[$rn],$all_rollno))
                    {
                        $old_attend = AttendanceCount::where('roll_number',$request->rollno[$rn])->where('subject_id',$request->subject_id)->first();

                        AttendanceCount::where('roll_number',$request->rollno[$rn])->where('subject_id',$request->subject_id)->update([
                            'attended'=>$old_attend->attended+1,
                        ]);
                    }
                }

                Attendance::where('course_id', $request->course_id)->where('batch_id', $request->batch_id)->where('subject_id', $request->subject_id)->where('attendance_date', $request->attendance_date)->update([
                    'attendance' => $attendance_json
                ]);

                return redirect()->route('attendance.create')->with('success','Attendance updated');

            } else {
                for($rn=0;$rn<count($request->rollno);$rn++)
                {
                    // echo "<br>".$request->rollno[$rn]."<br>";
                    if(in_array($request->rollno[$rn],$all_rollno))
                    {
                        $old_attend = AttendanceCount::where('roll_number',$request->rollno[$rn])->where('subject_id',$request->subject_id)->first();

                        AttendanceCount::where('roll_number',$request->rollno[$rn])->where('subject_id',$request->subject_id)->update([
                            'total_lecture'=>$old_attend->total_lecture+1,
                            'attended'=>$old_attend->attended+1,
                        ]);
                    }
                    else{
                        $old_attend = AttendanceCount::where('roll_number',$request->rollno[$rn])->where('subject_id',$request->subject_id)->first();

                        AttendanceCount::where('roll_number',$request->rollno[$rn])->where('subject_id',$request->subject_id)->update([
                            'total_lecture'=>$old_attend->total_lecture+1,
                        ]);
                    }
                }

                //Mark New day attendance
                Attendance::create([
                    'course_id' => $request->course_id,
                    'batch_id' => $request->batch_id,
                    'subject_id' => $request->subject_id,
                    'attendance_date' => $request->attendance_date,
                    'attendance' => $attendance_json
                ]);

                return redirect()->route('attendance.create')->with('success','Attendance Marked');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function batchAjax($id)
    {
        $course_id = $id;
        $batches = Batch::where('course_id', $course_id)->get();
        $subject = Subject::where('course_id', $course_id)->get();
        $data['batches'] = $batches;
        $data['subject'] = $subject;
        return json_encode($data);
    }
    public function studentAjax($course_id, $batch_id, $subject_id, $a_date)
    {
        $data = Student::where('course_id', $course_id)->get();
        return json_encode($data);
    }

    public function viewBatchAjax($id)
    {
        $course_id = $id;
        $batches = Batch::where('course_id', $course_id)->get();
        $subject = Subject::where('course_id', $course_id)->get();
        $data['batches'] = $batches;
        $data['subject'] = $subject;
        return json_encode($data);
    }

    public function viewAttendanceAjax($course_id, $batch_id, $subject_id, $a_date)
    {
        $data = Attendance::where('course_id',$course_id)->where('subject_id',$subject_id)->where('batch_id',$batch_id)->where('attendance_date',$a_date)->first();
        // echo $data->attendance;
        $decoded = json_decode($data->attendance);
        // header('content-type:text/javascript');
        // echo json_encode($decoded,JSON_PRETTY_PRINT);
        foreach($decoded as $key => $value)
        {
            $student = Student::where('roll_number',$key)->first();
            $dd['rollno'] = $key;
            $dd['student_name'] = $student->name;
            $dd['attendance'] = $value;
            $total_data[] = $dd;
            // echo $key."=>".$value."<br>";
        }
        // print_r($total_data);
        return json_encode($total_data);
    }
}
