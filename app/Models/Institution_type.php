<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institution_type extends Model
{
    use HasFactory;
    protected $table='institution_types';
    protected $fillable=['private','public','admission'];

}
