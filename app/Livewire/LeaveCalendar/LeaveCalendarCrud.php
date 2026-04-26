<?php

namespace App\Livewire\LeaveCalendar;

use Livewire\Component;
use App\Models\LeaveCalendar;
use Illuminate\Support\Facades\DB;
use App\Models\LeaveCalendarDetail;

 

class LeaveCalendarCrud extends Component
{
    public $activeTab = 'leave-calendar';
    public $updateMode = false;
    public $calendars;
    public $calendar_id;
    public $title;

    public $calendarDetails = [];

  
    public $holiday = [];
    public $flexible_day = [];
    public $descriptions = [];

    public $weekend_day;
    public $weekend_description;


    public function load()
    {
        $details = LeaveCalendarDetail::where('leave_calendar_id', $this->calendar_id)->get();

        $this->calendarDetails = $details;

        foreach ($details as $detail) {
            $this->holiday[$detail->id] = $detail->holiday;
            $this->flexible_day[$detail->id] = $detail->flexible_day;
            $this->descriptions[$detail->id] = $detail->descriptions;
        }
    }

    public function updateAll()
    {
        foreach ($this->calendarDetails as $detail) {

            LeaveCalendarDetail::where('id', $detail->id)->update([
                'holiday' => $this->holiday[$detail->id] ?? 0,
                'flexible_day' => $this->flexible_day[$detail->id] ?? 0,
                'descriptions' => $this->descriptions[$detail->id] ?? null,
            ]);
        }

        $this->dispatch('show-toast', message: 'Calendar Updated Successfully.');
    }

    public function applyWeekend()
    {
        if (!$this->weekend_day) {
            $this->dispatch('show-toast', message: 'Please select weekend day.');
            return;
        }

        foreach ($this->calendarDetails as $detail) {

            if ($detail->day === $this->weekend_day) {

                $this->holiday[$detail->id] = 1;
                $this->descriptions[$detail->id] = $this->weekend_description;
            }
        }

        $this->dispatch('show-toast', message: 'Weekend applied successfully.');
    }

    public function cancelWeekend()
    {
        if (!$this->weekend_day) {
            return;
        }

        foreach ($this->calendarDetails as $detail) {

            if (strtolower($detail->day) === strtolower($this->weekend_day)) {
    
                $this->holiday[$detail->id] = 0;
                $this->descriptions[$detail->id] = '';
            }
        }

        $this->dispatch('show-toast', message: 'Weekend removed successfully.');
    }

    public function openWeekendModal()
    {
        $this->weekend_day = 'Friday'; // default
        $this->weekend_description = '';
    }

    public function render()
    {

        $this->calendars = LeaveCalendar::all();

        if (!$this->calendar_id && $this->calendars->count() > 0) {
            $this->calendar_id = $this->calendars->first()->id;
        }

        return view('livewire.leave-calendar.leave-calendar-crud')
            ->layout('layouts.app', [
                'title' => 'Leave Calendar',
                'sub_title' => 'Calendar Details'
            ]);
    }

    public function store()
    {
        $validatedData = $this->validate([
                'title' => 'required|string|max:255',
        ]);
        //$validatedData['year'] = date('Y');  
        //$calendar = LeaveCalendar::create($validatedData);

        $calendar = DB::statement("CALL sp_execute_leave_calender(?)",[$validatedData['title']]);

        $this->dispatch('show-toast', message: ucfirst($this->activeTab) . ' Created Successfully.');
    
        $this->resetInputFields();
        $this->updateMode = false;
    }

    private function resetInputFields()
    {
        $this->calendar_id = null;
        $this->name = '';
    }

    public function create()
    {
        $this->resetInputFields();
        $this->updateMode = true;
 
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }
}
