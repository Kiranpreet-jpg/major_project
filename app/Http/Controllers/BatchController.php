<?php

namespace App\Http\Controllers;

use App\Models\AssignTeacher;
use App\Models\Batch;
use App\Models\Course;
use Illuminate\Http\Request;

class BatchController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:batch-list|batch-create|batch-edit|batch-delete', ['only' => ['index','store']]);
        $this->middleware('permission:batch-create', ['only' => ['create','store']]);
        $this->middleware('permission:batch-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:batch-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $batch = Batch::with('course')->get();
        return view("batch.index",compact('batch'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $course = Course::get();
        return view("batch.create",compact('course'));
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
            'course_id' => 'required',
        ]);
        Batch::create([
            'course_id'=>$request->course_id,
            'description'=>$request->description,
            'name'=>$request->name,
        ]);
        return redirect()->route('schoolbatch.create')->with('success', 'Record Insert Successfully');
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
        $batch = Batch::findorfail($id);
        $course = Course::get();

        return view('batch.edit', compact('batch','course'));


        // return view("batch.edit",compact('course'));
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
        ]);
        Batch::where('id',$id)->update([
            'name'=>$request->name,
            'course_id'=>$request->course_id,
            'description'=>$request->description,
        ]);

        return redirect()->route('schoolbatch.index')->with('success', 'Record Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $batch = Batch::findorfail($id);
        if(AssignTeacher::where('batch_id',$id)->exists())
        {
            return redirect()->route('schoolbatch.index')->with('error','Assigned teachers exists in this batch ,please delete them first');
        }
        $batch->delete();
        return redirect()->route('schoolbatch.index')->with('success', 'Record Deleted Successfully');

    }
}
