<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;
    protected $fillable = ([
        'student_user_id', 'title','discription'
    ]);

    public function student(){
        return $this->hasOne('App\Models\User','id','student_user_id');
    }
}
