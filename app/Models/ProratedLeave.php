<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProratedLeave extends Model
{
    
    protected $fillable = [
                            'schedule_id', 
                            'leave_type_id', 
                            'january', 
                            'february', 
                            'march', 
                            'april', 
                            'may',
                            'june',
                            'july',
                            'august',
                            'september',
                            'october',
                            'november',
                            'december',
                            ]; 

    public function schedule()
    {
        return $this->belongsTo(LeaveSchedule::class, 'schedule_id');
    }

    public function leave_type()
    {
        return $this->belongsTo(Parameter::class, 'leave_type_id');
    }
}
