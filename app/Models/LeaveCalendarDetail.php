<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LeaveCalendarDetail extends Model
{
    protected $fillable = ['leave_calendar_id', 'year', 'date','day','holiday', 'flexible_day', 'descriptions']; 
}


 