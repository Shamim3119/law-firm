<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hearing extends Model
{
       protected $fillable = ['court_id', 'hearing_date', 'hearing_time', 'case_id']; 


       public function court()
       {
              return $this->belongsTo(Court::class);
       }
}


