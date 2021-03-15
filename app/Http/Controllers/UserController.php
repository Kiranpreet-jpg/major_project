<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;

class UserController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:teacher-list|teacher-create|teacher-edit|teacher-delete', ['only' => ['index','store']]);
         $this->middleware('permission:teacher-create', ['only' => ['create','store']]);
         $this->middleware('permission:teacher-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:teacher-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User::with('teacher')->where('role','Teacher')->orderBy('id','DESC')->get();

        return view('users.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'roles' => 'required',
            'contact' => 'required',
            'gender' => 'required',
            'qualification' => 'required'
        ]);

        // $input = $request->all();
        // $input['password'] = bcrypt($input['password']);

        // $user = User::create($input);
        if ($request->has('image')) {

            $pic = $request->file('image');
            $updated_name = rand() . "." . $pic->getClientOriginalExtension();
            $pic->move(public_path('teacher_image'), $updated_name);
        } else {
            $updated_name = 'no-image.jpg';
        }

        $user_roles = $request->roles;
        $role_user = $user_roles[0];

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'contact' => $request->contact,
            'address' => $request->address,
            'gender' => $request->gender,
            'date_of_birth' => $request->date_of_birth,
            'image' => $updated_name,
            'role' => $role_user,
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

        $user->assignRole($request->roles);
        return redirect()->route('users.create')
                        ->with('success','User created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::with('teacher')->where('id',$id)->first();
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();

        return view('users.edit',compact('user','roles','userRole'));
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
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'roles' => 'required',
            'contact' => 'required',
            'gender' => 'required',
            'qualification' => 'required'
        ]);

        $input = $request->all();
        $user = User::with('teacher')->find($id);

        // header('Content-type:text/javascript');
        // echo json_encode($user,JSON_PRETTY_PRINT);
        // die();

        if(!empty($input['password'])){
            $password = bcrypt($input['password']);
            $plain_password = $input['password'];
        }else{
            $password = bcrypt(($user->teacher->password));
            $plain_password = $user->teacher->password;
        }

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

            Teacher::where('user_id',$id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $plain_password,
                'contact' => $request->contact,
                'address' => $request->address,
                'gender' => $request->gender,
                'date_of_birth' => $request->date_of_birth,
                'image' => $updated_name,
                'qualification' => $request->qualification,
                'date_of_joining' => $request->date_of_joining
            ]);

            $user = User::where('id',$user->teacher->user_id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $password,
                'contact' => $request->contact,
                'address' => $request->address,
                'gender' => $request->gender,
                'date_of_birth' => $request->date_of_birth,
                'image' => $updated_name,
            ]);


        } else {
            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'contact' => 'required',
                'gender' => 'required',
                'qualification' => 'required',
            ]);
            Teacher::where('user_id',$id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $plain_password,
                'contact' => $request->contact,
                'address' => $request->address,
                'gender' => $request->gender,
                'date_of_birth' => $request->date_of_birth,
                'qualification' => $request->qualification,
                'date_of_joining' => $request->date_of_joining
            ]);

            $user = User::where('id',$user->teacher->user_id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $password,
                'contact' => $request->contact,
                'address' => $request->address,
                'gender' => $request->gender,
                'date_of_birth' => $request->date_of_birth,
            ]);
        }
        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Teacher::where('user_id',$id)->delete();
        User::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }
}
