<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Level_recommendation extends Model
{
    use HasFactory;
    protected $table='level_recommendations';
    protected $fillable=['id_level','id_coach','id_student_test'];

}
