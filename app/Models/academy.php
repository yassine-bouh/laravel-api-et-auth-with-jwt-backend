<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Academy extends Model
{
    use HasFactory;
    protected $table='academies';
    protected $fillable=['name','resume','province','region','website','contact_email','contact_phone','contact_name'];
}
