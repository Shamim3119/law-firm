<?php

namespace App\Livewire\Appointment;

use Livewire\Component;

class AppointmentList extends Component
{

    public $appointments;
    public $activeTab = 'clients';

    public function mount()
    {
        if (request()->has('tab')) {
            $this->activeTab = request('tab');
        }
    }

    public function switchTab($tab)
    {
        $this->activeTab = $tab;
    }
    
    public function render()
    {
        $this->appointments = \App\Models\Appointment::all();

        return view('livewire.appointment.appointment-list')->layout('layouts.app', [
            'title' => 'Appointment',
            'sub_title' => 'Appointment List'
        ]);
    }

    public function delete($id)
    {
        \App\Models\Appointment::findOrFail($id)->delete();

        session()->flash('message', 'Appointment Deleted Successfully.');
    }

}



 
 





