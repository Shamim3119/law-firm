<?php

namespace App\Models;

use App\Models\Parameter;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = ['name', 'phone', 'email', 'department_id', 'designation_id']; 

    public function department()
    {
        return $this->belongsTo(Parameter::class, 'department_id');
    }

    public function designation()
    {
        return $this->belongsTo(Parameter::class, 'designation_id');
    }
}
