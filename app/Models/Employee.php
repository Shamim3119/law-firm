<?php

namespace App\Models;

use App\Models\Parameter;

use Illuminate\Database\Eloquent\Model;

 
class Employee extends Model
{
    protected $fillable = [
                            'name', 
                            'personal_email', 
                            'personal_phone', 
                            'department_id', 
                            'designation_id', 
                            'code',
                            'inactive',
                            'enroll_id',
                            'father_name',
                            'mother_name',
                            'date_of_birth',
                            'joining_date',
                            'career_start',
                            ]; 

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
