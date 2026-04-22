<?php

namespace App\Models;

use App\Models\Parameter;

use Illuminate\Database\Eloquent\Model;

 
/**
 * @property int $id
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property int $department_id
 * @property int $designation_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Parameter|null $department
 * @property-read Parameter|null $designation
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereDepartmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereDesignationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Employee whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Employee extends Model
{
    protected $fillable = ['name', 'phone', 'email', 'department_id', 'designation_id', 'code']; 

    public function department()
    {
        return $this->belongsTo(Parameter::class, 'department_id');
    }

    public function designation()
    {
        return $this->belongsTo(Parameter::class, 'designation_id');
    }

    public function attendance()
    {
        return $this->belongsTo(AttendanceSchedule::class, 'attendance_id');
    }

    public function leave()
    {
        return $this->belongsTo(LeaveSchedule::class, 'leave_id');
    }
    
    public function calendar()
    {
        return $this->belongsTo(LeaveCalendar::class, 'calendar_id');
    }
}
