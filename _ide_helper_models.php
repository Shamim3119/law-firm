<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
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
	class Appointment extends \Eloquent {}
}

namespace App\Models{
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
	class AppointmentDetails extends \Eloquent {}
}

namespace App\Models{
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
	class AppointmentStatus extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $title
 * @property string $descriptions
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cases newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cases newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cases query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cases whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cases whereDescriptions($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cases whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cases whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Cases whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Cases extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Client whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Client extends \Eloquent {}
}

namespace App\Models{
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
	class Employee extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $tag
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Parameter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Parameter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Parameter query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Parameter whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Parameter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Parameter whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Parameter whereTag($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Parameter whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Parameter extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class User extends \Eloquent {}
}

