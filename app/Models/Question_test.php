<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question_test extends Model
{
    use HasFactory;
    protected $table='question_tests';
    protected $fillable=['id_question','id_test','score'];
}
