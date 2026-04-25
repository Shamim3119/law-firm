<?php

namespace App\Livewire\Appointment;

use Livewire\Component;
use App\Models\Appointment;
use Livewire\Attributes\On;
use App\Models\Parameter;
use App\Models\AppointmentDetail;
use Illuminate\Support\Facades\DB;

class AppointmentForm extends Component
{

    public $appointment_id;
    public $type_id;
    public $title, $descriptions, $details;
    public $start_date;
    public $start_time;
    public $end_time;

    public $client;
    public $client_id;

    public $employee;
    public $employee_id;
    public $types = [];

 
    #[On('employeeSelected')]
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
        $this->types = Parameter::where('tag', 'appointment-type')->get();
        
        if ($id) {
            $appointment = Appointment::findOrFail($id);
            $this->appointment_id = $appointment->id;
            $this->title = $appointment->title;
            $this->descriptions = $appointment->descriptions;
            $this->type_id = $appointment->type_id;
            $this->details = $appointment->details;
            $this->start_date = $appointment->start_date;
            $this->start_time = $appointment->start_time;
            $this->end_time = $appointment->end_time;  
             
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
            'start_date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        if ($this->appointment_id) {
            // UPDATE
            $appointment = Appointment::findOrFail($this->appointment_id);

            $appointment->update([
                'title' => $this->title,
                'descriptions' => $this->descriptions,
                'employee_id' => $this->employee_id,
                'client_id' => $this->client_id,
                'type_id' => $this->type_id,
                'details' => $this->details,
                'start_date' => $this->start_date,
                'start_time' => $this->start_time,
                'end_time' => $this->end_time,
            ]);

        } else {
            // INSERT
            $appointmentCode = DB::select("SELECT fnc_get_code(2) as code")[0]->code;

            $appointment = Appointment::create([
                'title' => $this->title,
                'descriptions' => $this->descriptions,
                'employee_id' => $this->employee_id,
                'client_id' => $this->client_id,
                'type_id' => $this->type_id,
                'details' => $this->details,
                'start_date' => $this->start_date,
                'start_time' => $this->start_time,
                'end_time' => $this->end_time,
                'code' => $appointmentCode,
            ]);
        }

        AppointmentDetail::updateOrCreate(
            ['appointment_id' => $appointment->id],
            [
                'start_date' => $this->start_date,
                'start_time' => $this->start_time,
                'end_time' => $this->end_time,
                'details' => $this->details,
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
