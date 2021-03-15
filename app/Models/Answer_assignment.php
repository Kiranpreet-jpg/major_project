<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer_assignment extends Model
{
    use HasFactory;

    protected $fillable = ([
        'assignment_id','student_user_id','document','remarks','marks_allocated','type','subject_id'
    ]);

    public function assignment(){
        return $this->hasOne('App\Models\Assignment','id','assignment_id');
    }

    public function student()
    {
        return $this->hasOne('App\Models\Student','id','student_user_id');
    }

    public function subject()
    {
        return $this->hasOne('App\Models\Subject','id','subject_id');
    }
}
