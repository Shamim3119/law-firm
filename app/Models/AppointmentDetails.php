<?php

namespace App\Models;
 

use Illuminate\Database\Eloquent\Model;

class AppointmentDetails extends Model
{
    protected $fillable = ['appointment_id','appointment_date', 'appointment_start_time', 'appointment_end_time', 'appointment_details'];
    protected $table = 'appointment_detais';
}
 