<?php

namespace App\Livewire\Employee;

use Livewire\Component;

class EmployeeList extends Component
{

    public $employees;
    public $activeTab = 'employees';

    public function mount()
    {
        if (request()->has('tab')) {
            $this->activeTab = request('tab');
        }
    }

    public function switchTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function render()
    {
        $this->employees = \App\Models\Employee::all();

        return view('livewire.employee.employee-list')->layout('layouts.app', [
            'title' => 'Employee',
            'sub_title' => 'Employee List'
        ]);
    }

    public function delete($id)
    {
        \App\Models\Employee::findOrFail($id)->delete();

        session()->flash('message', 'Employee Deleted Successfully.');
    }
 
}
