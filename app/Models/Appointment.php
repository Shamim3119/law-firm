<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = ['title', 
                            'descriptions', 
                            'employee_id', 
                            'client_id', 
                            'appointment_type_id',
                            'appointment_date',
                            'appointment_start_time', 
                            'appointment_end_time', 
                            'appointment_details', 
                            'appointment_code',
                            'status_id',
                            ]; 

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }


    public function status()
    {
        return $this->belongsTo(AppointmentStatus::class);
    }

    public function appointment_type()
    {
        return $this->belongsTo(Parameter::class, 'appointment_type_id');
    }
}