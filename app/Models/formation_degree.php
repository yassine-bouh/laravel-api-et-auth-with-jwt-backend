<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formation_degree extends Model
{
    use HasFactory;
    protected $table='formation_degrees';
    protected $fillable=['id_formation','id_degree'];

}
