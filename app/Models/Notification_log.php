<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification_log extends Model
{
    use HasFactory;
    protected $table='notification_logs';
    protected $fillable=['module','notification','send_status','to','bc','bcc','subject','body','send_date'];
}

