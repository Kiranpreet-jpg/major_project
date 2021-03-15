<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = ([
        'user_id','name','email','password','contact','address','gender','date_of_birth','roll_number','course_id','semester','father_name','nationality','image','batch_id'
    ]);

    public function course()
    {
        return $this->hasOne('App\Models\Course', 'id', 'course_id');
    }

    public function batch()
    {
        return $this->hasOne('App\Models\Batch', 'id', 'batch_id');
    }
}
