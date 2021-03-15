<?php

namespace App\Http\Controllers;

use App\Models\AssignTeacher;
use App\Models\Teacher;
use App\Models\Batch;
use Illuminate\Http\Request;

class AssignTeachersController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:assign-teacher-list|assign-teacher-create|assign-teacher-edit|assign-teacher-delete', ['only' => ['index','store']]);
        $this->middleware('permission:assign-teacher-create', ['only' => ['create','store']]);
        $this->middleware('permission:assign-teacher-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:assign-teacher-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assignTeacher = AssignTeacher::with('batch', 'teacher')->get();
        return view("assignTeachers.index",compact('assignTeacher'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teacher = Teacher::get();
        $batch = Batch::get();
        return view("assignTeachers.create",compact('batch', 'teacher'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(AssignTeacher::where('batch_id',$request->batch_id)->where('teacher_user_id',$request->teacher_user_id)->exists())
        {
            return redirect()->route('teacherAssign.create')->with('error', 'Record already exists');
        }
        else{

            AssignTeacher::create([
                'batch_id'=>$request->batch_id,
                'teacher_user_id'=>$request->teacher_user_id,
            ]);
            return redirect()->route('teacherAssign.create')->with('success', 'Record Insert Successfully');
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
        $assignTeacher = AssignTeacher::findorfail($id);
        $batch = Batch::get();
        $teacher = Teacher::get();

        return view('assignTeachers.edit', compact('assignTeacher','batch','teacher'));
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
        AssignTeacher::where('id',$id)->update([
            'batch_id'=>$request->batch_id,
            'teacher_user_id'=>$request->teacher_user_id,
        ]);

        return redirect()->route('teacherAssign.index')->with('success', 'Record Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $assignTeacher = AssignTeacher::findorfail($id);
        $assignTeacher->delete();
        return redirect()->route('teacherAssign.index')->with('success', 'Record Deleted Successfully');
    }
}
