<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student_test extends Model
{
    use HasFactory;
    protected $table='student_tests';
    protected $fillable=['id_student','id_test','id_axe','score','comment'];
}
