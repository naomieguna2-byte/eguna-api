<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
    'student_number',
    'firstname',
    'middlename',
    'lastname',
    'email',
    'course',
    'year_level',
];
}
