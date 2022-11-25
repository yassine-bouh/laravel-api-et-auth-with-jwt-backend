<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Family_job extends Model
{
    use HasFactory;
    protected $table='family_jobs';
    protected $fillable=['resume','detail'];
}
