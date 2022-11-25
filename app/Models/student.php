<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $table='students';
    protected $fillable=['record_number','civility','firstname','lastname','birth_date','nationality','adress','city','postal_code','phone','parent_phone','email','school_level','school','opned_date','photo'];

}
