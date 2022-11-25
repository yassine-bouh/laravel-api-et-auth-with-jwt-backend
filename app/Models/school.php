<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;
    protected $table='schools';
    protected $fillable=['name','resume','city','id_academy','id_region','id_school_level','type','email','phone','mobile','address','contact_name','website'];
}
