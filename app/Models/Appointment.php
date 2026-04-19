<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

 
class Appointment extends Model
{
    protected $fillable = ['title', 
                            'descriptions', 
                            'employee_id', 
                            'client_id', 
                            'type_id',
                            'start_date',
                            'start_time', 
                            'end_time', 
                            'details', 
                            'code',
                            'status_id',
                            'note',
                            ]; 
  
                            /*
    protected $table = 'appointment_details';

    public function details()
    {
        return $this->hasMany(AppointmentDetail::class, 'appointment_id');
    }
*/
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