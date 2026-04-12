<?php

namespace App\Models;
 

use Illuminate\Database\Eloquent\Model;

 
/**
 * @property int $id
 * @property int $appointment_id
 * @property string $appointment_date
 * @property string $appointment_start_time
 * @property string $appointment_end_time
 * @property string|null $appointment_details
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AppointmentDetails newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AppointmentDetails newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AppointmentDetails query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AppointmentDetails whereAppointmentDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AppointmentDetails whereAppointmentDetails($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AppointmentDetails whereAppointmentEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AppointmentDetails whereAppointmentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AppointmentDetails whereAppointmentStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AppointmentDetails whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AppointmentDetails whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AppointmentDetails whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AppointmentDetails extends Model
{
    protected $fillable = ['appointment_id','appointment_date', 'appointment_start_time', 'appointment_end_time', 'appointment_details'];
    protected $table = 'appointment_detais';
}
 