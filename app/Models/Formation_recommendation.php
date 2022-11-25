<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formation_recommendation extends Model
{
    use HasFactory;
    protected $table='formation_recommendations';
    protected $fillable=['id_formation','id_coach','id_student_test'];

}
