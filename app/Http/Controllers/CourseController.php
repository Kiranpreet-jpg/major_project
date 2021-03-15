<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Batch;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Notes;

class CourseController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:course-list|course-create|course-edit|course-delete', ['only' => ['index','store']]);
         $this->middleware('permission:course-create', ['only' => ['create','store']]);
         $this->middleware('permission:course-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:course-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $course = Course::get();
        return view('course.index', compact('course'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("course.create");
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
            'name' => 'required',
            'image' => 'required',
        ]);

        $pic = $request->file('image');
        $new_name = rand() . "." . $pic->getClientOriginalExtension();
        $pic->move(public_path('course_image'), $new_name);

        $form_data = array(
            'name' => $request->name,
            'description' => $request->description,
            'image' => $new_name


        );
        /* $pic= new Pic([
            'name'=>$request->get('name')

        ]);*/

        Course::create($form_data);
        // $student->save();
        return redirect()->route('course.create')->with('success', 'Record Insert Successfully');

        // return view('course.create')->with('Success', 'Record Insert Successfully');
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
        $course = Course::findorfail($id);

        return view('course.edit', compact('course'));
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
        $image_name = $request->hidden_image;
        $pic = $request->file('image');
        if ($pic != '') {
            $request->validate([
                'name' => 'required',
                'image' => 'required'
            ]);

            $image_name = rand() . "." . $pic->getClientOriginalExtension();
            $pic->move(public_path('course_image'), $image_name);
        } else {
            $request->validate([
                'name' => 'required',

            ]);
        }
        $form_data = array(
            'name' => $request->name,
            'description' => $request->description,
            'image'  => $image_name
        );
        Course::whereId($id)->update($form_data);

        return redirect()->route('course.index')->with('success', 'Record Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $course = Course::findorfail($id);
        if(Batch::where('course_id',$id)->exists())
        {
            return redirect()->route('course.index')->with('error','Batches exists in this course ,please delete them first');
        }
        else if(Student::where('course_id',$id)->exists())
        {
            return redirect()->route('course.index')->with('error','Students exists in this course ,please delete them first');
        }
        else if(Subject::where('course_id',$id)->exists())
        {
            return redirect()->route('course.index')->with('error','Subjects exists in this course ,please delete them first');
        }
        else if(Assignment::where('course_id',$id)->exists())
        {
            return redirect()->route('course.index')->with('error','Assignments exists in this course ,please delete them first');
        }
        else if(Notes::where('course_id',$id)->exists())
        {
            return redirect()->route('course.index')->with('error','Assignments exists in this course ,please delete them first');
        }
        else{
            $course->delete();
            return redirect()->route('course.index')->with('success', 'Record Deleted Successfully');
        }


    }
}
