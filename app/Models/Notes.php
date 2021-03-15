<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notes extends Model
{
    use HasFactory;
    protected $fillable = ([
        'title',
        'description',
        'course_id',
        'semester',
        'teacher_user_id',
        'subject_id',
        'document',
        'uploaded_date',
        'uploaded_time'
    ]);
    
    public function course(){
        return $this->hasOne('App\Models\Course','id','course_id');
    } 
    public function user(){
        return $this->hasOne('App\Models\User','id','teacher_user_id');
    } 
    public function subject(){
        return $this->hasOne('App\Models\Subject','id','subject_id');
    } 
}
