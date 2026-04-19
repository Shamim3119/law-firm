<?php

namespace App\Livewire\Appointment;

use Livewire\Component;
use App\Models\Appointment;
use App\Models\AppointmentDetail;
use Livewire\Attributes\On;

class AppointmentDetailsCrud extends Component
{
    public $details_id;
    public $appointment_id;
    public $start_date;
    public $start_time;
    public $end_time;
    public $details;
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
            $appointments = AppointmentDetail::where('appointment_id', $this->appointment_id)
                ->orderBy('id', 'desc')  
                ->get();
        }

        return view('livewire.appointment.appointment-details-crud', [
            'appointments' => $appointments
        ]);
    }

    private function resetInputFields()
    {
        $this->start_date = '';
        $this->start_time = '';
        $this->end_time = '';
        $this->details = '';
    }

    public function store()
    {
        $validatedData = $this->validate([
            'start_date' => 'required|string',
            'start_time' => 'required|string',
            'end_time' => 'required|string',
            'details' => 'required|string',
        ]);

        $appointments = Appointment::findOrFail($this->appointment_id);

        $appointments->update([
 
            'details' => $this->details,
            'start_date' => $this->start_date,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'status_id' => '2',
        ]);

        if ($this->details_id) {
            $appointment = AppointmentDetail::find($this->details_id);

            if ($appointment) {
                $appointment->update($validatedData);
                $this->dispatch('show-toast', message: 'Updated Successfully.');
         
            }
        } else {
            $validatedData['appointment_id'] = $this->appointment_id;
            AppointmentDetail::create($validatedData);
            $this->dispatch('show-toast', message: 'Created Successfully.');
  
        }

        $this->resetInputFields();
        $this->updateMode = false;
    }

    public function edit($id)
    {
        $appointment = AppointmentDetail::findOrFail($id);

        $this->details_id = $appointment->id;
        $this->start_date = $appointment->start_date;
        $this->start_time = $appointment->start_time;
        $this->end_time = $appointment->end_time;
        $this->details = $appointment->details;

        $this->updateMode = true;
    }


    public function delete($id)
    {
        AppointmentDetail::find($id)?->delete();
        session()->flash('message', 'Appointment Detais Deleted Successfully.');
        $this->dispatch('show-toast', message: session('message'));
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }
    
}
