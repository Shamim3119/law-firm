<?php

namespace App\Models;

use App\Models\Parameter;

use Illuminate\Database\Eloquent\Model;

 
class Employee extends Model
{
    protected $fillable = ['name', 'phone', 'email', 'department_id', 'designation_id', 'code']; 

    public function department()
    {
        return $this->belongsTo(Parameter::class, 'department_id');
    }

    public function designation()
    {
        return $this->belongsTo(Parameter::class, 'designation_id');
    }

    public function attendance()
    {
        return $this->belongsTo(AttendanceSchedule::class, 'attendance_id');
    }

    public function leave()
    {
        return $this->belongsTo(LeaveSchedule::class, 'leave_id');
    }
    
    public function calendar()
    {
        return $this->belongsTo(LeaveCalendar::class, 'calendar_id');
    }
}
