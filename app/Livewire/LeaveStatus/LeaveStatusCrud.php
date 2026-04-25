<?php

namespace App\Livewire\LeaveStatus;

use Livewire\Component;
use Livewire\Attributes\On;

class LeaveStatusCrud extends Component
{

    public $flag = true;
    public $updateMode = false;
    public $activeTab = 'leave-status';



    public function render()
    {
        return view('livewire.leave-status.leave-status-crud');
    }
}
