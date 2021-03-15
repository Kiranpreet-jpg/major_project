<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notes;
use App\Models\Course;
use App\Models\Subject;
use App\Models\User;

class NotesController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:notes-list|notes-create|notes-edit|notes-delete', ['only' => ['index','store']]);
        $this->middleware('permission:notes-create', ['only' => ['create','store']]);
        $this->middleware('permission:notes-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:notes-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $note = Notes::with('course', 'user', 'subject')->get();
        return view("notes.index", compact('note'));
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
        return view("notes.create", compact('course', 'user', 'subject'));
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
            'uploaded_date' => 'required',
            'uploaded_time' => 'required'
        ]);

        $file = $request->file('document');
        $updated_name = rand() . "." . $file->getClientOriginalExtension();
        $file->move(public_path('upload_notes_documents'), $updated_name);

        Notes::create([
            'title' => $request->title,
            'description' => $request->description,
            'course_id' => $request->course_id,
            'semester' => $request->semester,
            'teacher_user_id' => $request->teacher_user_id,
            'subject_id' => $request->subject_id,
            'document' => $updated_name,
            'uploaded_date' => $request->uploaded_date,
            'uploaded_time' => $request->uploaded_time
        ]);
        return redirect()->route('notes.create')->with('success', 'Record Insert Successfully');
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
        $notes = Notes::findorfail($id);
        $course = Course::get();
        $subject = Subject::get();
        $user = User::get();

        return view('Notes.edit', compact('notes', 'course', 'subject', 'user'));
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
                'semester' => 'required',
                'document' => 'required',
                'uploaded_date' => 'required',
                'uploaded_time' => 'required',
                'course_id' => 'required',
                'teacher_user_id' => 'required',
                'subject_id' => 'required',
            ]);

            $file = $request->file('document');
            $updated_name = rand() . "." . $file->getClientOriginalExtension();
            $file->move(public_path('upload_notes_documents'), $updated_name);

            Notes::whereId($id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'course_id' => $request->course_id,
                'semester' => $request->semester,
                'teacher_user_id' => $request->teacher_user_id,
                'subject_id' => $request->subject_id,
                'document' => $updated_name,
                'uploaded_date' => $request->uploaded_date,
                'uploaded_time' => $request->uploaded_time
            ]);
        } else {
            $request->validate([
                'title' => 'required',
                'semester' => 'required',
                'uploaded_date' => 'required',
                'uploaded_time' => 'required',
                'course_id' => 'required',
                'teacher_user_id' => 'required',
                'subject_id' => 'required',

            ]);
            Notes::whereId($id)->update([
                'title' => $request->title,
                'description' => $request->description,
                'course_id' => $request->course_id,
                'semester' => $request->semester,
                'teacher_user_id' => $request->teacher_user_id,
                'subject_id' => $request->subject_id,
                'uploaded_date' => $request->uploaded_date,
                'uploaded_time' => $request->uploaded_time
            ]);
            return redirect()->route('notes.index')->with('success', 'Record Updated Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $notes = Notes::findorfail($id);
        $image_path = public_path('/upload_notes_documents').'/'.$notes->document;
        unlink($image_path);
        $notes->delete();
        return redirect()->route('notes.index')->with('success', 'Record Deleted Successfully');
    }
}
