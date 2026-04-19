<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Court extends Model
{
     protected $fillable = ['court_no', 'name', 'chief_justice', 'case_id', 'inactive']; 
}
