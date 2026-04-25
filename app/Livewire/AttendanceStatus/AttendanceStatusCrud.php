<?php

namespace App\Livewire\AttendanceStatus;

use Livewire\Component;
use Livewire\Attributes\On;

class AttendanceStatusCrud extends Component
{
    public $flag = true;
    public $updateMode = false;
    public $activeTab = 'attendance-status';

    public function render()
    {
        return view('livewire.attendance-status.attendance-status-crud');
    }
}
