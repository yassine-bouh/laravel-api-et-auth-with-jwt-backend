<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student_test_category_score extends Model
{
    use HasFactory;
    protected $table='student_test_category_scores';
    protected $fillable=['id_student_test','id_category','score'];
}
