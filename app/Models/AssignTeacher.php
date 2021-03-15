<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignTeacher extends Model
{
    use HasFactory;
    protected $fillable = ([
        'teacher_user_id', 'batch_id'
    ]);

    public function batch(){
        return $this->hasOne('App\Models\Batch','id','batch_id');
    }
    public function teacher(){
        return $this->hasOne('App\Models\User','id','teacher_user_id');
    }
}
