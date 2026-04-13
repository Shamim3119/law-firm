<?php

namespace App\Livewire\Appointment;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Appointment;

class AppointmentStatus extends Component
{
    public $appointment_id;
    public $status_id;
    public $note;
 

    // 🔥 Receive ID from parent
    #[On('setAppointmentStatusId')]
    public function setAppointmentStatusId($id)
    {
        $this->appointment_id = $id;
        $this->resetInputFields();  
    }

    private function resetInputFields()
    {
        $this->status_id = '';
        $this->note = '';
    }


 
    public function save()
    {
        $validatedData = $this->validate([
            'status_id' => 'required|integer',
           'note' => 'nullable|string',
        ]);

        Appointment::where('id', $this->appointment_id)->update([
            'status_id' => $this->status_id,
            'note' => $this->note,
        ]);

        session()->flash('message', 'Appoinment Status Changed Successfully.');
        $this->dispatch('show-toast', message: session('message'));

        $this->resetInputFields();
 
        $this->dispatch('closeModal');

        $this->dispatch('refreshAppointments');
    }

    public function render()
    {
        return view('livewire.appointment.appointment-status');
    }


    
}