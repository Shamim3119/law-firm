<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
 
/**
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AppointmentStatus newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AppointmentStatus newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AppointmentStatus query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AppointmentStatus whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AppointmentStatus whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AppointmentStatus whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AppointmentStatus whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AppointmentStatus extends Model
{
    protected $fillable = ['id', 'name'];  
 
    protected $table = 'appointment_status';
}
