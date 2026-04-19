<?php

namespace App\Models;
 

use Illuminate\Database\Eloquent\Model;

 
class AppointmentDetail extends Model
{
    protected $fillable = ['appointment_id','start_date', 'start_time', 'end_time', 'details'];
    protected $table = 'appointment_details';
}
 