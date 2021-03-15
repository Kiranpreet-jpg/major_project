<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceCount extends Model
{
    use HasFactory;

    protected $fillable = ([
        'roll_number','total_lecture','attended','subject_id'
    ]);
    
    public function subject(){
        return $this->hasOne('App\Models\Subject','id','subject_id');
    } 
}
