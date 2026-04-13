<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 
 
class Cases extends Model
{
    protected $fillable = [ 
                            'appointment_id', 
                            'client_id', 
                            'employee_id', 
                            'title', 
                            'descriptions', 
                            'code', 
                            'charge',
                            'payment',
                            'due',
                            ]; 

    public function appointment()
    {
        return $this->belongsTo(Appointment::class, 'appointment_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
