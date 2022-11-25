<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscription extends Model
{
    use HasFactory;
    protected $table='inscriptions';
    protected $fillable=['id_invoice','id_student_coach','id_program','last_status','last_status_date'];

}
