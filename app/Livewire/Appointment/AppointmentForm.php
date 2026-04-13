<?php

namespace App\Livewire\Appointment;

use Livewire\Component;
use App\Models\Appointment;
use Livewire\Attributes\On;
use App\Models\Parameter;
use App\Models\AppointmentDetails;
use Illuminate\Support\Facades\DB;

class AppointmentForm extends Component
{

    public $appointment_id;
    public $appointment_type_id;
    public $title, $descriptions, $appointment_details;
    public $appointment_date;
    public $appointment_start_time;
    public $appointment_end_time;

    public $client;
    public $client_id;

    public $employee;
    public $employee_id;
    public $appointment_types = [];

 
    #[On('EmployeeSelected')]
    public function employeeSelected($data)
    {
        $this->employee = $data['name'];
        $this->employee_id = $data['id'];
    }

    #[On('clientSelected')]
    public function clientSelected($data)
    {
        $this->client = $data['name'];
        $this->client_id = $data['id'];
    }

    public function mount($id = null)
    {
        $this->appointment_types = Parameter::where('tag', 'appointment-type')->get();
        
        if ($id) {
            $appointment = Appointment::findOrFail($id);
            $this->appointment_id = $appointment->id;
            $this->title = $appointment->title;
            $this->descriptions = $appointment->descriptions;
            $this->appointment_type_id = $appointment->appointment_type_id;
            $this->appointment_details = $appointment->appointment_details;
            $this->appointment_date = $appointment->appointment_date;
            $this->appointment_start_time = $appointment->appointment_start_time;
            $this->appointment_end_time = $appointment->appointment_end_time;  
             
            $this->employee = $appointment->employee->name ?? '';
            $this->employee_id = $appointment->employee_id;

            $this->client_id = $appointment->client_id;
            $this->client = $appointment->client->name ?? '';

        }
    }


    public function save()
    {
        $this->validate([
            'title' => 'required',
            'descriptions' => 'required',
            'employee_id' => 'required',
            'client_id' => 'required',
        ]);

        if ($this->appointment_id) {
            // UPDATE
            $appointment = Appointment::findOrFail($this->appointment_id);

            $appointment->update([
                'title' => $this->title,
                'descriptions' => $this->descriptions,
                'employee_id' => $this->employee_id,
                'client_id' => $this->client_id,
                'appointment_type_id' => $this->appointment_type_id,
                'appointment_details' => $this->appointment_details,
                'appointment_date' => $this->appointment_date,
                'appointment_start_time' => $this->appointment_start_time,
                'appointment_end_time' => $this->appointment_end_time,
            ]);

        } else {
            // INSERT
            $appointmentCode = DB::select("SELECT fnc_get_code(2) as code")[0]->code;

            $appointment = Appointment::create([
                'title' => $this->title,
                'descriptions' => $this->descriptions,
                'employee_id' => $this->employee_id,
                'client_id' => $this->client_id,
                'appointment_type_id' => $this->appointment_type_id,
                'appointment_details' => $this->appointment_details,
                'appointment_date' => $this->appointment_date,
                'appointment_start_time' => $this->appointment_start_time,
                'appointment_end_time' => $this->appointment_end_time,
                'code' => $appointmentCode,
            ]);
        }

        AppointmentDetails::updateOrCreate(
            ['appointment_id' => $appointment->id],
            [
                'appointment_date' => $this->appointment_date,
                'appointment_start_time' => $this->appointment_start_time,
                'appointment_end_time' => $this->appointment_end_time,
                'appointment_details' => $this->appointment_details,
            ]
        );

        session()->flash('message', $this->appointment_id ? 'Appointment Updated Successfully' : 'Appointment Created Successfully');

        return redirect()->route('appointment.index', ['tab' => 'appointments', 'flag' => 'true']);
    }

    public function render()
    {
        return view('livewire.appointment.appointment-form')->layout('layouts.app', [
            'title' => $this->appointment_id ? 'Edit Appointment' : 'Add Appointment',
            'sub_title' => 'Appointment Form'
        ]);
    }
 
}
