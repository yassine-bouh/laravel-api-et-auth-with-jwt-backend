<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School_level extends Model
{
    use HasFactory;
    protected $table='school_levels';
    protected $fillable=['prescolaire','primaire','college','lycee'];
}
