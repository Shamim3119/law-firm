<?php

namespace App\Livewire\Appointment;

use Livewire\Component;
use App\Models\Appointment;
use App\Models\AppointmentDetails;
use Livewire\Attributes\On;

class AppointmentDetailsCrud extends Component
{
    public $appointment_details_id;
    public $appointment_id;
    public $appointment_date;
    public $appointment_start_time;
    public $appointment_end_time;
    public $appointment_details;
    public $updateMode = false;
    public $selectedAppointmentId;


    #[On('setAppointmentId')]
    public function setAppointmentId($id)
    {
        $this->appointment_id = $id;

        $this->resetInputFields();  
    }

    public function render()
    {
        $appointments = [];

        if ($this->appointment_id) {
            $appointments = AppointmentDetails::where('appointment_id', $this->appointment_id)
                ->orderBy('id', 'desc')  
                ->get();
        }

        return view('livewire.appointment.appointment-details-crud', [
            'appointments' => $appointments
        ]);
    }

    private function resetInputFields()
    {
        $this->appointment_date = '';
        $this->appointment_start_time = '';
        $this->appointment_end_time = '';
        $this->appointment_details = '';
    }

    public function store()
    {
        $validatedData = $this->validate([
            'appointment_date' => 'required|string',
            'appointment_start_time' => 'required|string',
            'appointment_end_time' => 'required|string',
            'appointment_details' => 'required|string',
        ]);

        $appointments = Appointment::findOrFail($this->appointment_id);

        $appointments->update([
 
            'appointment_details' => $this->appointment_details,
            'appointment_date' => $this->appointment_date,
            'appointment_start_time' => $this->appointment_start_time,
            'appointment_end_time' => $this->appointment_end_time,
            'status_id' => '2',
        ]);

        if ($this->appointment_details_id) {
            $appointment = AppointmentDetails::find($this->appointment_details_id);

            if ($appointment) {
                $appointment->update($validatedData);
                $this->dispatch('show-toast', message: 'Updated Successfully.');
         
            }
        } else {
            $validatedData['appointment_id'] = $this->appointment_id;
            AppointmentDetails::create($validatedData);
            $this->dispatch('show-toast', message: 'Created Successfully.');
  
        }

        $this->resetInputFields();
        $this->updateMode = false;
    }

    public function edit($id)
    {
        $appointment = AppointmentDetails::findOrFail($id);

        $this->appointment_details_id = $appointment->id;
        $this->appointment_date = $appointment->appointment_date;
        $this->appointment_start_time = $appointment->appointment_start_time;
        $this->appointment_end_time = $appointment->appointment_end_time;
        $this->appointment_details = $appointment->appointment_details;

        $this->updateMode = true;
    }


    public function delete($id)
    {
        AppointmentDetails::find($id)?->delete();
        session()->flash('message', 'Appointment Detais Deleted Successfully.');
        $this->dispatch('show-toast', message: session('message'));
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }
    
}
