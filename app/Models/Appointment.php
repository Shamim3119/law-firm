<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

 
/**
 * @property int $id
 * @property string|null $appointment_code
 * @property int|null $status_id
 * @property string $title
 * @property string $descriptions
 * @property int|null $employee_id
 * @property int|null $client_id
 * @property string|null $appointment_details
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $appointment_type_id
 * @property string|null $appointment_date
 * @property string|null $appointment_start_time
 * @property string|null $appointment_end_time
 * @property-read \App\Models\Parameter|null $appointment_type
 * @property-read \App\Models\Client|null $client
 * @property-read \App\Models\Employee|null $employee
 * @property-read \App\Models\AppointmentStatus|null $status
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment whereAppointmentCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment whereAppointmentDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment whereAppointmentDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment whereAppointmentEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment whereAppointmentStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment whereAppointmentTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment whereDescriptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment whereEmployeeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment whereStatusId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Appointment whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Appointment extends Model
{
    protected $fillable = ['title', 
                            'descriptions', 
                            'employee_id', 
                            'client_id', 
                            'appointment_type_id',
                            'appointment_date',
                            'appointment_start_time', 
                            'appointment_end_time', 
                            'appointment_details', 
                            'code',
                            'status_id',
                            'note',
                            ]; 

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }


    public function status()
    {
        return $this->belongsTo(AppointmentStatus::class);
    }

    public function appointment_type()
    {
        return $this->belongsTo(Parameter::class, 'appointment_type_id');
    }
}