<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppointmentStatus extends Model
{
    protected $fillable = ['id', 'name'];  
 
    protected $table = 'appointment_status';
}
