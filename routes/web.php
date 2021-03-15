<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * Admin Login
 */
// Route::get('/', function () {
//     return view('auth.login');
// });

Route::get('admin/login',function(){
    return view('auth.login');
});

/**
 * hide registration for admin
 */
Auth::routes(['register' => false]);

/**
 * admin Home Page
 */
Route::get('/home', 'HomeController@index')->name('home');

/**
 * Roles and Permissions
 */
Route::group(['middleware' => ['auth']], function() {
Route::resource('roles',App\Http\Controllers\RoleController::class);
Route::resource('users',App\Http\Controllers\UserController::class);

/**
 * Dashboard
 */
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/**
 * Teacher
 */
Route::resource('teacher', App\Http\Controllers\TeacherController::class);

/**
 * Course
 */
Route::resource('course', App\Http\Controllers\CourseController::class);

/**
 * SchoolBatch
 */
Route::resource('schoolbatch', App\Http\Controllers\BatchController::class);

/**
 * Subjects
 */
Route::resource('subjects', App\Http\Controllers\SubjectController::class);

/**
 * TeaherAssign
 */
Route::resource('teacherAssign', App\Http\Controllers\AssignTeachersController::class);

/**
 * Student
 */
Route::resource('student', App\Http\Controllers\StudentController::class);
Route::get('student/studentBatchAjax/{id}',[App\Http\Controllers\StudentController::class,'studentBatchAjax']);

/**
 * Notes
 */
Route::resource('notes', App\Http\Controllers\NotesController::class);

/**
 * Student as per teacher
 */
Route::resource('studentAsPerTeacher', App\Http\Controllers\ManageStudentAsPerTeacherController::class);

Route::get('studentAsPerTeacher/studentTeacherBatchAjax/{id}',[App\Http\Controllers\ManageStudentAsPerTeacherController::class,'studentTeacherBatchAjax']);

/**
 * Assignments
 */
Route::resource('assignments', App\Http\Controllers\AssignmentsController::class);

/**
 * Feedback
 */
Route::resource('feedback', App\Http\Controllers\FeedbackController::class);

/**
 * View Answer Assignment
 */
Route::resource('viewAnswerAssignment', App\Http\Controllers\AnswerAssignmentController::class);
Route::get('assignment/batchAjax/{id}',[App\Http\Controllers\AnswerAssignmentController::class,'batchAjax']);
Route::get('assignment/assignmentAjax/{course_id}/{subject_id}',[App\Http\Controllers\AnswerAssignmentController::class,'assignmentAjax']);
Route::get('assignment/assignmentAnsAjax/{assignment_id}', [App\Http\Controllers\AnswerAssignmentController::class, 'showAssignmentAjax']);

/**
 * Attendance
 */
Route::resource('attendance', App\Http\Controllers\AttendanceController::class);
Route::get('attendance/batchAjax/{id}',[App\Http\Controllers\AttendanceController::class,'batchAjax']);
Route::get('studentAjax/{course_id}/{batch_id}/{subject_id}/{a_date}',[App\Http\Controllers\AttendanceController::class,'studentAjax']);
Route::get('viewAttendanceAjax/{course_id}/{batch_id}/{subject_id}/{a_date}',[App\Http\Controllers\AttendanceController::class,'viewAttendanceAjax']);
Route::get('attendance/viewBatchAjax/{id}',[App\Http\Controllers\AttendanceController::class,'viewBatchAjax']);

});

/***************************************
                Web Routes
 ***************************************/

/**
 * web/login
 */
Route::get('/', [App\Http\Controllers\web\LoginController::class, 'login']);
Route::get('/web/login', [App\Http\Controllers\web\LoginController::class, 'login'])->name('web.login');
Route::post('/web/login/check', [App\Http\Controllers\web\LoginController::class, 'logincheck'])->name('web.logincheck');
Route::post('/web/logout', [App\Http\Controllers\web\LoginController::class, 'logout'])->name('web.logout');

/**
 * web/home
 */
Route::get('/web/home', [App\Http\Controllers\web\HomeController::class, 'index'])->name('web.home');
// Route::get('web/home', [App\Http\Controllers\web\HomeController::class, 'index']);

/**
 * Student Assignments
 */
Route::resource('stuAssignment', App\Http\Controllers\web\AssignmentController::class);

/**
 * Student Notes
 */
Route::resource('stuNotes', App\Http\Controllers\web\NotesController::class);

/**
 * Student Attendance
 */
Route::get('/web/attendance', [App\Http\Controllers\web\AttendanceController::class, 'viewAttendance'])->name('web.viewAttendance');
Route::get('/web/attendance/show/{id}', [App\Http\Controllers\web\AttendanceController::class, 'showAttendanceAsPerSubject'])->name('web.showAttendanceAsPerSubject');

/**
 * Student Feedback
 */
Route::resource('feedbacks', App\Http\Controllers\web\FeedbackController::class);
