<?php

namespace App\Livewire\AttendanceInfo;

use Livewire\Component;
use Livewire\Attributes\On;

class AttendanceInfoCrud extends Component
{
    public $flag = true;
    public $updateMode = false;
    public $activeTab = 'attendance-info';


    public function render()
    {
        return view('livewire.attendance-info.attendance-info-crud');
    }
}
