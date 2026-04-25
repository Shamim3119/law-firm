<?php

namespace App\Livewire\ProratedLeave;

use Livewire\Component;
use App\Models\Parameter;
use App\Models\LeaveSchedule;
use App\Models\ProratedLeave;

class ProratedLeaveCrud extends Component
{
    public $activeTab = 'prorated-leave';
    public $updateMode = false;
    public $showForm = false;
    public $isModal = false;
    public $prorateds;
    public $leave_types;
    public $schedules;

    public $prorated_id;
    public $schedule_id;
    public $leave_type_id;
 
    public $january;
    public $february;
    public $march;
    public $april;
    public $may;
    public $june;
    public $july;
    public $august;
    public $september;
    public $october;
    public $november;
    public $december;


    public function render()
    {
        $this->leave_types = Parameter::where('tag', 'leave-type')->get();
        $this->schedules = LeaveSchedule::all();
        $this->prorateds = ProratedLeave::all();

        return view('livewire.prorated-leave.prorated-leave-crud')
            ->layout('layouts.app', [
                'title' => 'Prorated Leave',
                'sub_title' => 'Prorated Leave List'
            ]);
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
 
    private function resetInputFields()
    {
        $this->prorated_id = null;
 
        $this->january = '';
        $this->february = '';
        $this->march = '';
        $this->april = '';
        $this->may = '';
        $this->june = '';
        $this->july = '';
        $this->august = '';
        $this->september = '';
        $this->october = '';
        $this->november = '';
        $this->december = '';
 
    }

    public function store()
    {
        $validatedData = $this->validate([
            'schedule_id' => 'required|integer|min:0',
            'leave_type_id' => 'required|integer|min:0',
            'january' => 'required|integer|min:0',

            'february' => 'required|integer|min:0',
            'march' => 'required|integer|min:0',
            'april' => 'required|integer|min:0',
            'may' => 'required|integer|min:0',
            'june' => 'required|integer|min:0',
            'july' => 'required|integer|min:0',
            'august' => 'required|integer|min:0',
            'september' => 'required|integer|min:0',
            'october' => 'required|integer|min:0',
            'november' => 'required|integer|min:0',
            'december' => 'required|integer|min:0',
        ]);
        if ($this->prorated_id) {
            $prorated = ProratedLeave::find($this->prorated_id);
            if ($prorated) {
                $prorated->update($validatedData);
                $this->dispatch('show-toast', message: ucfirst($this->activeTab) . ' Updated Successfully.');
            }
        } else {
            ProratedLeave::create($validatedData);
            $this->dispatch('show-toast', message: ucfirst($this->activeTab) . ' Created Successfully.');
        }

        $this->resetInputFields();
        $this->updateMode = false;
        $this->showForm = false;
    }

    public function edit($id)
    {
        if ($id) {
            $prorated = ProratedLeave::findOrFail($id);

            $this->prorated_id = $id;
            $this->schedule_id = $prorated->schedule_id;
            $this->leave_type_id = $prorated->leave_type_id;
            $this->january = $prorated->january;
            $this->february = $prorated->february;
            $this->march = $prorated->march;
            $this->april = $prorated->april;
            $this->may = $prorated->may;
            $this->june = $prorated->june;
            $this->july = $prorated->july;
            $this->august = $prorated->august;
            $this->september = $prorated->september;
            $this->october = $prorated->october;
            $this->november = $prorated->november;
            $this->december = $prorated->december;

            $this->updateMode = true;
            $this->showForm = true;
        }
    }

    public function delete($id)
    {
        ProratedLeave::find($id)?->delete();
 
        $this->dispatch('show-toast', message: 'Prorated Leave Deleted Successfully.');
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
