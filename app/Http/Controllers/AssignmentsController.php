<?php

namespace App\Http\Controllers;

use App\Models\Answer_assignment;
use App\Models\Assignment;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Subject;
use App\Models\User;
use League\CommonMark\Block\Element\Document;

class AssignmentsController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:assignment-list|assignment-create|assignment-edit|assignment-delete', ['only' => ['index','store']]);
        $this->middleware('permission:assignment-create', ['only' => ['create','store']]);
        $this->middleware('permission:assignment-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:assignment-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assignment = Assignment::with('course', 'user', 'subject')->get();
        return view("assignment.index", compact('assignment'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $course = Course::get();
        $user = User::get();
        $subject = Subject::get();
        return view("assignment.create", compact('course', 'user', 'subject'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'semester' => 'required',
            'document' => 'required',
            'due_date' => 'required',
            'due_time' => 'required',
            'marks' => 'required',
        ]);

        $file = $request->file('document');
        $updated_name = rand() . "." . $file->getClientOriginalExtension();
        $file->move(public_path('upload_assignments_documents'), $updated_name);

        Assignment::create([
            'title' => $request->title,
            'description' => $request->description,
            'course_id' => $request->course_id,
            'semester' => $request->semester,
            'teacher_user_id' => $request->teacher_user_id,
            'subject_id' => $request->subject_id,
            'document' => $updated_name,
            'due_date' => $request->due_date,
            'due_time' => $request->due_time,
            'marks' => $request->marks,
            'type'=>$request->type
        ]);
        return redirect()->route('assignments.create')->with('success', 'Record Insert Successfully');
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
        $assignment = Assignment::findorfail($id);
        $course = Course::get();
        $subject = Subject::get();
        $user = User::get();

        return view('assignment.edit', compact('assignment', 'course', 'subject', 'user'));
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
        if ($request->file('document')) {

            $request->validate([
                'title' => 'required',
                'course_id' => 'required',
                'semester' => 'required',
                'teacher_user_id' => 'required',
                'subject_id' => 'required',
                'due_date' => 'required',
                'due_time' => 'required',
                'marks' => 'required',
                'document' => 'required'
            ]);

            $pic = $request->file('document');
            $new_name = rand() . "." . $pic->getClientOriginalExtension();
            $pic->move(public_path('upload_assignments_documents'), $new_name);
            Assignment::whereId($id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'course_id' => $request->course_id,
                'semester' => $request->semester,
                'teacher_user_id' => $request->teacher_user_id,
                'subject_id' => $request->subject_id,
                'document' => $new_name,
                'due_date' => $request->due_date,
                'due_time' => $request->due_time,
                'marks' => $request->marks,
                'type'=>$request->type
            ]);

        } else {
             $request->validate([
                'title' => 'required',
                'course_id' => 'required',
                'semester' => 'required',
                'teacher_user_id' => 'required',
                'subject_id' => 'required',
                'due_date' => 'required',
                'due_time' => 'required',
                'marks' => 'required',
            ]);
            Assignment::whereId($id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'course_id' => $request->course_id,
                'semester' => $request->semester,
                'teacher_user_id' => $request->teacher_user_id,
                'subject_id' => $request->subject_id,
                'due_date' => $request->due_date,
                'due_time' => $request->due_time,
                'marks' => $request->marks,
                'type'=>$request->type
            ]);
        }


        return redirect()->route('assignments.index')->with('success', 'Record Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $assignment = Assignment::findorfail($id);
        if(Answer_assignment::where('assignment_id',$id)->exists())
        {
            return redirect()->route('assignments.index')->with('error','Answer Assignment exists in this assignment ,please delete them first');
        }
        if($assignment->document != null)
        {
            $file_path = public_path('/upload_assignments_documents').'/'.$assignment->document;

            if ( \File::exists( 'upload_assignments_documents/'.$assignment->document ) ) {
                unlink('upload_assignments_documents/'.$assignment->document);
            }
        }
        $assignment->delete();
        return redirect()->route('assignments.index')->with('success', 'Record Deleted Successfully');
    }
}
