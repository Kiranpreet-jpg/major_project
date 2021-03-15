<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Answer_assignment;
use App\Models\Assignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;

class AssignmentController extends Controller {
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function index() {
        // Auth::user();
        if ( Auth::user() ) {
            $student_detail = Student::with( 'course' )->where( 'user_id', Auth::user()->id )->first();

            $assignment1 = Assignment::with( 'course', 'user', 'subject' )->get();

            $new_array1 = array();
            $assignment = array();

            for ( $i = 0; $i<count( $assignment1 );
            $i++ ) {
                if ( Answer_assignment::where( 'assignment_id', $assignment1[$i]->id )->where( 'student_user_id', Auth::user()->id )->exists() ) {
                    $answers = Answer_assignment::where( 'assignment_id', $assignment1[$i]->id )->where( 'student_user_id', Auth::user()->id )->first();

                    $new_array1['answer'] = $answers->document;
                    $new_array1['marks_allocated'] = $answers->marks_allocated;
                    // $new_array1['answer'] = $answers->document;
                } else {
                    $new_array1['answer'] = '-';
                    $new_array1['marks_allocated'] = '-';
                }
                $new_array1['id'] = $assignment1[$i]->id;
                $new_array1['title'] = $assignment1[$i]->title;
                $new_array1['type'] = $assignment1[$i]->type;
                $new_array1['description'] = $assignment1[$i]->description;
                $new_array1['marks'] = $assignment1[$i]->marks;
                $new_array1['document'] = $assignment1[$i]->document;
                $new_array1['semester'] = $assignment1[$i]->semester;
                $new_array1['due_date'] = $assignment1[$i]->due_date;
                $new_array1['due_time'] = $assignment1[$i]->due_time;
                $new_array1['name'] = $assignment1[$i]->user->name;
                $new_array1['course'] = $assignment1[$i]->course->name;
                $new_array1['subject'] = $assignment1[$i]->subject->name;

                $assignment[] = $new_array1;
            }

            // header( 'content-type:text/javascript' );
            // echo json_encode( $new_array2, JSON_PRETTY_PRINT );
            // die();
            return view( 'web.assignment.index', compact( 'assignment','student_detail') );
        } else {
            return view( 'web.login' );
        }
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */

    public function create() {
        //
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */

    public function store( Request $request ) {
        // print_r( $request->all() );
        $assignment = Assignment::where( 'id', $request->assignment_id )->first();
        $count = Answer_assignment::where( 'assignment_id', $assignment->id )->where( 'student_user_id', Auth::user()->id )->count();
        // echo $count;
        // die();
        if ( $count == 0 ) {

            $pic = $request->file( 'answer' );
            $new_name = rand() . '.' . $pic->getClientOriginalExtension();
            $pic->move( public_path( 'answers' ), $new_name );

            Answer_assignment::create( [
                'assignment_id'=>$assignment->id,
                'student_user_id'=> Auth::user()->id,
                'document'=>$new_name,
                'type'=>$assignment->type,
                'subject_id'=>$assignment->subject_id
            ] );
            return redirect()->back()->with( 'success', 'Answer Uploaded for '.$assignment->type.' '.$assignment->title );
        } else {
            return redirect()->back()->with( 'error', 'Answer already Uploaded for '.$assignment->type.' '.$assignment->title );
        }
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function show( $id ) {
        //
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function edit( $id ) {
        //
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function update( Request $request, $id ) {
        //
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */

    public function destroy( $id ) {
        //
    }
}
