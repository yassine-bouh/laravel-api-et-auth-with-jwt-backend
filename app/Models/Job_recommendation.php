<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job_recommendation extends Model
{
    use HasFactory;
    protected $table='job_recommendations';
    protected $fillable=['id_job','id_coach','id_student_test'];

}
