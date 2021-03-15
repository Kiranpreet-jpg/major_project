<?php

namespace App\Http\Controllers;

use App\Models\Answer_assignment;
use App\Models\Assignment;
use App\Models\AssignTeacher;
use App\Models\Batch;
use App\Models\Course;
use App\Models\Subject;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class AnswerAssignmentController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:view-answer-assignment', ['only' => ['index']]);
        $this->middleware('permission:view-assignment-answer-detail', ['only' => ['show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        if($user)
        {
            $assign_batch = AssignTeacher::where('teacher_user_id',$user->id)->get();

            $assign_course = array();
            for($i=0;$i<count($assign_batch);$i++)
            {
                $batch = Batch::where('id',$assign_batch[$i]->batch_id)->first();
                $assign_course[] = $batch->course_id;
            }

            $course = array();
            for($j=0;$j<count($assign_course);$j++)
            {

                $courses = Course::where('id',$assign_course)->first();
                $course[] = $courses;
            }

            return view('viewAnswerAssignment.index', compact('course'));
        }
        else{
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $answer = Answer_assignment::with('assignment','student','subject')->findorfail($id);

        $course = Course::where('id',$answer->assignment->course_id)->first();
        $batch = Batch::where('id',$answer->student->batch_id)->first();
        // $final_data  = array();

        $final_data['assignment_title'] = $answer->assignment->title;
        $final_data['course'] = $course['name'];
        $final_data['batch'] = $batch['name'];
        $final_data['semester'] = $answer->assignment->semester;
        $final_data['subject'] = $answer->subject->name;
        $final_data['due_date'] = $answer->assignment->due_date;
        $final_data['due_time'] = $answer->assignment->due_time;
        $final_data['marks'] = $answer->assignment->marks;
        $final_data['question_paper'] = $answer->assignment->document;
        $final_data['answer_sheet'] = $answer->document;
        $final_data['student_name'] = $answer->student->name;
        $final_data['marks_allocated'] = $answer->marks_allocated;
        $final_data['id'] = $answer->id;

        // header('Content-type:text/javascript');
        // echo json_encode($batch,JSON_PRETTY_PRINT);
        // die();

        return view('viewAnswerAssignment.show',compact('final_data'));

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
        Answer_assignment::where('id',$id)->update([
            'marks_allocated'=>$request->marks_allocated
        ]);

        return redirect()->route('viewAnswerAssignment.index')->with('success','Marks Assigned');
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
        $batches = Batch::where('course_id',$course_id)->get();
        $subject = Subject::where('course_id',$course_id)->get();
        $data['batches'] = $batches;
        $data['subject'] = $subject;
        return json_encode($data);
    }

    public function assignmentAjax($course_id,$subject_id)
    {
        // $assignments = Assignment::where('course_id',$course_id)->where('subject_id',$subject_id)->where('type','assignment')->get();
        $assignments = Assignment::where('course_id',$course_id)->where('subject_id',$subject_id)->get();
        return json_encode($assignments);
    }

    public function showAssignmentAjax($assignment_id)
    {
        $answerAssignments = Answer_assignment::with('student','assignment')->where('assignment_id', $assignment_id)->get();
        return json_encode($answerAssignments);
    }
}
