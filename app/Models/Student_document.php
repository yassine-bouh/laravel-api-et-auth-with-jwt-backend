<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student_document extends Model
{
    use HasFactory;
    protected $table='student_documents';
    protected $fillable=['id_student','id_document'];

}
