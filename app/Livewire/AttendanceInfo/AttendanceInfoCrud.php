<?php

namespace App\Livewire\AttendanceInfo;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\DB;

class AttendanceInfoCrud extends Component
{
    public $flag = true;
    public $updateMode = false;
    public $activeTab = 'attendance-info';


    public function render()
    {
        $attendance = DB::statement("CALL sp_select_attendance()");

        return view('livewire.attendance-info.attendance-info-crud', [
            'attendance' => $attendance,
        ])->layout('layouts.app', [
            'title' => 'Attendance',
            'sub_title' => 'Attendance List'
        ]);
    }
}
