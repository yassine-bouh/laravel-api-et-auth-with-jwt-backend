<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscription_status extends Model
{
    use HasFactory;
    protected $table='inscription_statuses';
    protected $fillable=['status','date','id_inscription'];

}
