<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    use HasFactory;
    protected $table='institutions';
    protected $fillable=['name','resume','website','email','phone','mobile','city','address','country','contact_name','logo','id_institution_type'];


}
