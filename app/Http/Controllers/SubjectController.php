<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Notes;

class SubjectController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:subject-list|subject-create|subject-edit|subject-delete', ['only' => ['index','store']]);
        $this->middleware('permission:subject-create', ['only' => ['create','store']]);
        $this->middleware('permission:subject-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:subject-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subject = Subject::with('course')->get();
        return view("subject.index",compact('subject'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $course = Course::get();
        return view("subject.create",compact('course'));
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
            'course_id' => 'required',
            'semester' => 'required',
            'name' => 'required',

        ]);
        Subject::create([
            'course_id'=>$request->course_id,
            'semester'=>$request->semester,
            'name'=>$request->name,
            'description' =>$request->description
        ]);
        return redirect()->route('subjects.create')->with('success', 'Record Insert Successfully');
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
        $subject = Subject::findorfail($id);
        $course = Course::get();

        return view('subject.edit', compact('subject','course'));
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
        $request->validate([
            'name' => 'required',
            'course_id' => 'required',
            'description' => 'required',
            'semester' => 'required'
        ]);
        Subject::where('id',$id)->update([
            'name'=>$request->name,
            'course_id'=>$request->course_id,
            'description'=>$request->description,
            'semester' =>$request->semester
        ]);

        return redirect()->route('subjects.index')->with('success', 'Record Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subject = Subject::findorfail($id);
        if(Assignment::where('subject_id',$id)->exists())
        {
            return redirect()->route('subjects.index')->with('error','Assignments exists in this Subject ,please delete them first');
        }
        else if(Notes::where('subject_id',$id)->exists())
        {
            return redirect()->route('course.index')->with('error','Notes exists in this subject ,please delete them first');
        } else {
            $subject->delete();
            return redirect()->route('subjects.index')->with('success', 'Record Deleted Successfully');
        }

    }
}
