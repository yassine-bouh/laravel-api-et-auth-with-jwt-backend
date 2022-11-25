<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category_job extends Model
{
    use HasFactory;
    protected $table='category_jobs';
    protected $fillable=['id_category','id_job'];
}
