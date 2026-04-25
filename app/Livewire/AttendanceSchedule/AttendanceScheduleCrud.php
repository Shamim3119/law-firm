<?php

namespace App\Livewire\AttendanceSchedule;

use Livewire\Component;
use App\Models\AttendanceSchedule;
use Livewire\Attributes\On;
use App\Models\Employee;
use Carbon\Carbon;


class AttendanceScheduleCrud extends Component
{

    public $activeTab = 'Attendance Schedule';
    public $updateMode = false;
    public $schedules;
    public $isModal = false;

    public $schedule_id;
    public $name;
    public $start_time;
    public $end_time;
    public $interval_start;
    public $interval_end;
    public $late_count;


    public $employee_id;

    #[On('setEmployeeId')]
    public function setEmployeeId($data)
    {
        if (!$data) 
            return;

        $this->employee_id = $data['id'];
    }

    public function selectSchedule($scheduleId)
    {
        if (!$this->employee_id) return;

        Employee::where('id', $this->employee_id)
            ->update(['attendance_id' => $scheduleId]);

        // ✅ close modal
        $this->dispatch('close-attendance-modal');

        // ✅ VERY IMPORTANT → trigger refresh
        $this->dispatch('refreshEmployees');

        // ✅ toast (fixed format)
        $this->dispatch('show-toast', message: 'Leave applied successfully');
    }

    public function mount()
    {
        if (request()->has('tab')) {
            $this->activeTab = request('tab');
        }
        if (request()->has('isModal')) {
            $this->isModal = true;
        }
    }
  

 
    public function render()
    {
        $this->schedules = AttendanceSchedule::all();

        return view('livewire.attendance-schedule.attendance-schedule-crud')
            ->layout('layouts.app', [
                'title' => 'Attendance Schedule',
                'sub_title' => 'Attendance Schedule List'
            ]);
    }


 
    private function resetInputFields()
    {
        $this->schedule_id = null;
        $this->name = '';
        $this->start_time = '';
        $this->end_time = '';
        $this->interval_start = '';
        $this->interval_end = '';
        $this->late_count = '';
    }

    public function store()
    {
        $validatedData = $this->validate([
                'name' => 'required|string|max:255',
                'start_time' => 'required|date_format:H:i',
                'end_time' => 'required|date_format:H:i|after:start_time',
                'interval_start' => 'nullable|date_format:H:i',
                'interval_end' => 'nullable|date_format:H:i|after:interval_start',
                'late_count' => 'required|integer|min:0',
        ]);
        if ($this->schedule_id) {
            $schedule = AttendanceSchedule::find($this->schedule_id);
            if ($schedule) {
                $schedule->update($validatedData);
                $this->dispatch('show-toast', message: ucfirst($this->activeTab) . ' Updated Successfully.');
            }
        } else {
            AttendanceSchedule::create($validatedData);
            $this->dispatch('show-toast', message: ucfirst($this->activeTab) . ' Created Successfully.');
        }

        $this->resetInputFields();
        $this->updateMode = false;
    }



    public function edit($id)
    {
        $schedule = AttendanceSchedule::findOrFail($id);

        $this->schedule_id = $id;
        $this->name = $schedule->name;

        $this->start_time = Carbon::parse($schedule->start_time)->format('H:i');
        $this->end_time = Carbon::parse($schedule->end_time)->format('H:i');
        $this->interval_start = $schedule->interval_start 
            ? Carbon::parse($schedule->interval_start)->format('H:i') 
            : null;
        $this->interval_end = $schedule->interval_end 
            ? Carbon::parse($schedule->interval_end)->format('H:i') 
            : null;

        $this->late_count = $schedule->late_count;

        $this->updateMode = true;
      //  $this->dispatch('open-edit-box');
    }

    public function delete($id)
    {
        AttendanceSchedule::find($id)?->delete();
 
        $this->dispatch('show-toast', message: 'Attendance Schedule Deleted Successfully.');
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function create()
    {
        $this->resetInputFields();
        $this->updateMode = true;
 
    }


}
