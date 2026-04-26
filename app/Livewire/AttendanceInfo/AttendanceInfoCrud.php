<?php

namespace App\Livewire\AttendanceInfo;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\DB;
use App\Models\Attendance;
use Carbon\Carbon;

class AttendanceInfoCrud extends Component
{
    public $flag = true;
    public $updateMode = false;
    public $activeTab = 'attendance-info';

    public $in_times = [];
    public $out_times = [];

    
    public function mount()
    {
        $attendances = DB::select("CALL sp_select_attendance()");

        foreach ($attendances as $a) {

            $key = $a->employee_id . '_' . $a->att_date;

            if ($a->in_time) {
                $this->in_times[$key] = \Carbon\Carbon::parse($a->in_time)->format('H:i');
            }

            if ($a->out_time) {
                $this->out_times[$key] = \Carbon\Carbon::parse($a->out_time)->format('H:i');
            }
        }
    }




public function render()
{
    $attendances = DB::select("CALL sp_select_attendance()");

    return view('livewire.attendance-info.attendance-info-crud', [
        'attendances' => $attendances,
    ]);
}

    public function updateAttendance($date, $in_out_flag, $employee_id)
    {
        $key = $employee_id . '_' . $date;
        $time = $in_out_flag === 0 ? ($this->in_times[$key] ?? null) : ($this->out_times[$key] ?? null);

        if (!$time) {

            $this->dispatch('show-toast', message: 'Time missing');
            return;
        }

        $datetime = $date . ' ' . $time . ':00';

        $attendance = Attendance::where('employee_id', $employee_id)
            ->whereDate('date', $date)
            ->first();

        if (!$attendance) {
            $attendance = new Attendance();
            $attendance->employee_id = $employee_id;
            $attendance->date = $date;
        }

        if ($in_out_flag === 0) {
            $attendance->in_time = $datetime;
        } else {
            $attendance->out_time = $datetime;
        }

        $attendance->save();

        $this->dispatch('show-toast', message: 'Successfully Updated');

        $this->dispatch('$refresh');
    }

}