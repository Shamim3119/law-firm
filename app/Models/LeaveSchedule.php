<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\LeaveScheduleDetail;

class LeaveSchedule extends Model
{
       protected $fillable = ['name', 'description']; 

       public function details()
       {
              return $this->hasMany(LeaveScheduleDetail::class, 'schedule_id');
       }
}




