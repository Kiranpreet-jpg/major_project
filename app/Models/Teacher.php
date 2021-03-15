<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    protected $fillable = ([
        'user_id',
        'name' ,
        'email' ,
        'password' ,
        'contact' ,
        'address' ,
        'gender' ,
        'date_of_birth' ,
        'image' ,
        'qualification' ,
        'date_of_joining' 
    ]);
}
