<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institution_formation extends Model
{
    use HasFactory;
    protected $table='institution_formations';
    protected $fillable=['id_formation','id_institution'];
}
