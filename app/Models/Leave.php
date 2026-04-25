<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    protected $fillable = [
                            'employee_id', 
                            'type_id', 
                            'schedule_id', 
                            'leave_from',
                            'leave_to',
                            'remarks',
                        ]; 

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
 
    public function leave_type()
    {
        return $this->belongsTo(Parameter::class, 'type_id');
    }

    public function leave_schedule()
    {
        return $this->belongsTo(LeaveSchedule::class, 'schedule_id');
    }

}

 