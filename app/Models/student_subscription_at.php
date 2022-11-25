<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student_subscription_at extends Model
{
    use HasFactory;
    protected $table='student_subscription_ats';
    protected $fillable=['id_student','id_subscription'];
}
