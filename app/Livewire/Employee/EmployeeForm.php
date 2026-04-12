<?php

namespace App\Livewire\Employee;

use Livewire\Component;
use App\Models\Employee;
use App\Models\Parameter;

class EmployeeForm extends Component
{
    public $employee_id;
    public $name, $phone, $email, $department_id, $designation_id;

    public $departments = [];
    public $designations = [];


    public function mount($id = null)
    {
        $this->departments = Parameter::where('tag', 'department')->get();
        $this->designations = Parameter::where('tag', 'designation')->get();

        if ($id) {
            $employee = Employee::findOrFail($id);
            $this->employee_id = $employee->id;
            $this->name = $employee->name;
            $this->phone = $employee->phone;
            $this->email = $employee->email;
            $this->department_id = $employee->department_id;
            $this->designation_id = $employee->designation_id;
        }
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|email',
            'department_id' => 'required|integer',
            'designation_id' => 'required|integer',
        ]);

        Employee::updateOrCreate(
            ['id' => $this->employee_id],
            [
                'name' => $this->name,
                'phone' => $this->phone,
                'email' => $this->email,
                'department_id' => $this->department_id,
                'designation_id' => $this->designation_id,
            ]
        );

        session()->flash('message', $this->employee_id ? 'Employee Updated Successfully' : 'Employee Created Successfully');
        
        
       // $this->dispatch('show-toast', message: session('message'));

        return redirect()->route('employee.index');
    }

    public function render()
    {
        return view('livewire.employee.employee-form')->layout('layouts.app', [
            'title' => $this->employee_id ? 'Edit Employee' : 'Add Employee',
            'sub_title' => 'Employee Form'
        ]);
    }


    public function delete($id)
    {
        Employee::findOrFail($id)->delete();

        session()->flash('message', 'Employee Deleted Successfully');
    //    $this->dispatch('show-toast', message: session('message'));
    }


}
