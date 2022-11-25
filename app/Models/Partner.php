<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
    use HasFactory;
    protected $table='partners';
    protected $fillable=['id_institution','id_user','occupation','firstname','lastname','address','city','country','mobile','email','detail'];

}
