<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = ['id', 'appointment_status', 'case_status'];  
 
    protected $table = 'statuses';
}
