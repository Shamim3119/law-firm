<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
        protected $fillable = [
                            'dr_id', 
                            'cr_id',
                            'dr_amount',
                            'cr_amount',
                            'dr_before',
                            'cr_before',
                            'dr_after',
                            'cr_after',
                            'description'
                        ]; 

 
}
