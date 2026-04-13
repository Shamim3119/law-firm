<?php

namespace App\Livewire\Appointment;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Appointment;

class AppointmentList extends Component
{
    public $appointments = [];
    public $activeTab = 'clients';
    public $flag = 'false';

    public function mount()
    {
        if (request()->has('tab')) {
            $this->activeTab = request('tab');
        }
        $this->flag = request()->get('flag', 'false');
        $this->loadAppointments();
    }

    // 🔥 Load data properly
    public function loadAppointments()
    {
        $query = Appointment::with(['client', 'employee', 'status']);

        if ($this->flag !== 'true') {
            $query->where('status_id', 3);
        }

        $this->appointments = $query->latest()->get();

    }

    // 🔥 Refresh after status update
    #[On('refreshAppointments')]
    public function refreshAppointments()
    {
        $this->loadAppointments();
    }

    public function switchTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function delete($id)
    {
        Appointment::findOrFail($id)->delete();

        session()->flash('message', 'Appointment Deleted Successfully.');

        $this->loadAppointments(); // 🔥 refresh list immediately
    }

    public function render()
    {
        return view('livewire.appointment.appointment-list')
            ->layout('layouts.app', [
                'title' => 'Appointment',
                'sub_title' => 'Appointment List'
            ]);
    }
}