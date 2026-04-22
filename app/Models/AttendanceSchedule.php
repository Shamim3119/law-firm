<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttendanceSchedule extends Model
{
 
    protected $fillable = [
                            'name', 
                            'business_id', 
                            'late_count', 
                            'start_time', 
                            'end_time',
                            'interval_start',
                            'interval_end',
                        ];
}
