<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\AssignTeacher;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Notes;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teacher = Teacher::get();

        return view("teacher.index", compact('teacher'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("teacher.create");
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
            'email' => 'required',
            'password' => 'required',
            'contact' => 'required',
            'gender' => 'required',
            'qualification' => 'required',
        ]);

        if ($request->has('image')) {

            $pic = $request->file('image');
            $updated_name = rand() . "." . $pic->getClientOriginalExtension();
            $pic->move(public_path('teacher_image'), $updated_name);
        } else {
            $updated_name = 'no-image.jpg';
        }
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'contact' => $request->contact,
            'address' => $request->address,
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'image' => $updated_name,
            'role' => 'Teacher',
        ]);

        $user_id = User::where('email', $request->email)->first();

        Teacher::create([
            'user_id' => $user_id->id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'contact' => $request->contact,
            'address' => $request->address,
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'image' => $updated_name,
            'qualification' => $request->qualification,
            'date_of_joining' => $request->date_of_joining
        ]);

        return redirect()->route('teacher.create')->with('success', 'Record Insert Successfully');
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
        $teacher = Teacher::findorfail($id);

        return view('teacher.edit', compact('teacher'));
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
        $updated_name = $request->hidden_image;
        $pic = $request->file('image');
        if ($pic != '') {
            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'contact' => 'required',
                'gender' => 'required',
                'qualification' => 'required',
            ]);

            $updated_name = rand() . "." . $pic->getClientOriginalExtension();
            $pic->move(public_path('teacher_image'), $updated_name);
        } else {
            $request->validate([
                'name' => 'required',

            ]);
        }
        Teacher::whereId($id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'contact' => $request->contact,
            'address' => $request->address,
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'image' => $updated_name,
            'qualification' => $request->qualification,
            'date_of_joining' => $request->date_of_joining
        ]);

        return redirect()->route('teacher.index')->with('success', 'Record Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        echo $teacher = Teacher::findorfail($id);

        if (AssignTeacher::where('teacher_user_id', $teacher->user_id)->exists()) {
            return redirect()->route('teacher.index')->with('error', 'This teachers is already been assigned ,please remove that assignment first');
        } else if (Assignment::where('teacher_user_id', $teacher->user_id)->exists()) {
            return redirect()->route('teacher.index')->with('error', 'This teachers exists in assignments ,please remove that assignment first');
        } else if (Notes::where('teacher_user_id', $teacher->user_id)->exists()) {
            return redirect()->route('teacher.index')->with('error', 'This teachers exists in Notes ,please remove that notes first');
        } else {

            $user = $teacher->user_id;
            if($teacher->image != null)
            {
                $image_path = public_path('/teacher_image') . '/' . $teacher->image;

                if ( \File::exists( 'teacher_image/'.$teacher->image ) ) {
                    unlink('teacher_image/'.$teacher->image);
                }
            }

            $teacher->delete();
            User::where('id', $user)->delete();
            return redirect()->route('teacher.index')->with('success', 'Record Deleted Successfully');
        }
    }
}
