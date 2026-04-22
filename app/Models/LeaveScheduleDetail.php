<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveScheduleDetail extends Model
{
    protected $fillable = ['schedule_id', 'leave_type_id', 'days']; 
}
