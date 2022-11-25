<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student_coach extends Model
{
    use HasFactory;
    protected $table='student_coaches';
    protected $fillable=['id_student','id_coach','entred_date'];
}
