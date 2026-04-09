<?php

namespace App\Livewire\Appointment;

use Livewire\Component;
use App\Models\Appointment;

class AppointmentForm extends Component
{

    public $appointment_id;
    public $title, $descriptions;

    public function mount($id = null)
    {
        if ($id) {
            $appointment = Appointment::findOrFail($id);
            $this->appointment_id = $appointment->id;
            $this->title = $appointment->title;
            $this->descriptions = $appointment->descriptions;
        }
    }

    public function save()
    {
        $this->validate([
            'title' => 'required',
            'descriptions' => 'required',
        ]);

        Appointment::updateOrCreate(
            ['id' => $this->appointment_id],
            [
                'title' => $this->title,
                'descriptions' => $this->descriptions,
            ]
        );

        session()->flash('message', $this->appointment_id ? 'Appointment Updated Successfully' : 'Appointment Created Successfully');

        return redirect()->route('appointment.index', ['tab' => 'appointments']);
    }

    
    public function render()
    {
        return view('livewire.appointment.appointment-form')->layout('layouts.app', [
            'title' => $this->appointment_id ? 'Edit Appointment' : 'Add Appointment',
            'sub_title' => 'Appointment Form'
        ]);
    }
 
}
