<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student_coach_meeting extends Model
{
    use HasFactory;
    protected $table='student_coach_meetings';
    protected $fillable=['id_student_coach','type','resume','detail','meeting_date'];
}
