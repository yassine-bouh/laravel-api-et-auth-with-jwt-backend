<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Update_log extends Model
{
    use HasFactory;
    protected $table='update_logs';
    protected $fillable=['module','field','old_value','new_value'];
}
