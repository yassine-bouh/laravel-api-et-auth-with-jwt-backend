<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test_axe extends Model
{
    use HasFactory;
    protected $table='test_axes';
    protected $fillable=['id_test','id_axe'];
}
