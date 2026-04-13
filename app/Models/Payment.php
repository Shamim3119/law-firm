<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
                            'type_id', 
                            'amount', 
                            'remarks', 
                            'case_id', 
                            'client_id', 
                            'employee_id', 
                            'appointment_id',
                            'active_amount',
                            'next_amount',
                            ]; 
 
}
