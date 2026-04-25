<?php

namespace App\Livewire\LeaveSchedule;

use Livewire\Component;
use App\Models\Parameter;
use App\Models\LeaveSchedule;
use App\Models\LeaveScheduleDetail;
use App\Models\Employee;
use Livewire\Attributes\On;

class LeaveScheduleCrud extends Component
{

    public $activeTab = 'leave-schedule';
    public $updateMode = false;
    public $schedules;
    public $leave_types;
    public $isModal = false;


    public $schedule_id;
    public $name;
    public $description;
 
    public $leave_values = [];

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
            ->update(['leave_id' => $scheduleId]);

        // ✅ close modal
        $this->dispatch('close-leave-modal');

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
        //$this->schedules = LeaveSchedule::all();
        $this->schedules = LeaveSchedule::with('details')->get();
        $this->leave_types = Parameter::where('tag', 'leave-type')->get();

        return view('livewire.leave-schedule.leave-schedule-crud')
            ->layout('layouts.app', [
                'title' => 'Leave Schedule',
                'sub_title' => 'Leave Schedule List'
            ]);
    }

    private function resetInputFields()
    {
        $this->schedule_id = null;
        $this->name = '';
        $this->description = '';
 
    }

    public function store()
    {
        $validatedData = $this->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        // dynamic validation for leave types
        foreach ($this->leave_values as $key => $value) {
            $rules["leave_values.$key"] = 'required|integer|min:0';
        }
        $this->validate($rules);

        if ($this->schedule_id) {

            // ✅ UPDATE
            $schedule = LeaveSchedule::find($this->schedule_id);

            if ($schedule) {
                $schedule->update($validatedData);

                // 👉 delete old details
                LeaveScheduleDetail::where('schedule_id', $schedule->id)->delete();

                // 👉 insert new details
                foreach ($this->leave_values as $leave_type_id => $days) {
                    LeaveScheduleDetail::create([
                        'schedule_id'   => $schedule->id,
                        'leave_type_id' => $leave_type_id,
                        'days'          => $days,
                    ]);
                }

                $this->dispatch('show-toast', message: ucfirst($this->activeTab) . ' Updated Successfully.');
            }

        } else {

            // ✅ CREATE
            $schedule = LeaveSchedule::create($validatedData);

            foreach ($this->leave_values as $leave_type_id => $days) {
                LeaveScheduleDetail::create([
                    'schedule_id'   => $schedule->id,
                    'leave_type_id' => $leave_type_id,
                    'days'          => $days,
                ]);
            }

            $this->dispatch('show-toast', message: ucfirst($this->activeTab) . ' Created Successfully.');
        }

        $this->resetInputFields();
        $this->updateMode = false;
    }

    public function edit($id)
    {
        $schedule = LeaveSchedule::with('details')->findOrFail($id);

        $this->schedule_id = $id;
        $this->name = $schedule->name;
        $this->description = $schedule->description;

        // 👉 IMPORTANT: reset first
        $this->leave_values = [];

        // 👉 fill leave values
        foreach ($schedule->details as $detail) {
            $this->leave_values[$detail->leave_type_id] = $detail->days;
        }

        // 👉 optional: ensure all leave types exist (fill 0 if missing)
        foreach ($this->leave_types as $leave_type) {
            if (!isset($this->leave_values[$leave_type->id])) {
                $this->leave_values[$leave_type->id] = 0;
            }
        }

        $this->updateMode = true;
      //  $this->dispatch('open-edit-box');
    }

    public function delete($id)
    {
        LeaveSchedule::find($id)?->delete();
 
        $this->dispatch('show-toast', message: 'Leave Schedule Deleted Successfully.');
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
