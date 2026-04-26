<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
     protected $fillable = [
                            'employee_id', 
                            'date', 
                            'in_time', 
                            'out_time', 
                            'act_in',
                            'act_out',
                            'status_id',
                            'year'
                        ];
 
}
