<?php

namespace App\Livewire\Employee;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Employee;
use App\Models\Parameter;
use App\Models\LeaveCalendar;
use Livewire\Attributes\On;


class EmployeeCrud extends Component
{
    use WithPagination;

    public $sortField = 'id';
    public $sortDirection = 'asc';
    protected $paginationTheme = 'bootstrap';
    public $activeTab = 'employees';
    public $perPage = 10;
    public $search = ''; // ✅ NEW
    public $page = 1;
    public $departmentFilter = '';
    public $designationFilter = '';
    
    public $flag = 'false';

    public $lawyer = null;
    public $updateMode = false;
    public $employee_id;
    public $name, $phone, $email, $department_id, $designation_id;

    public $departments = [];
    public $designations = [];

    public $calendars = [];


    public $selectedEmployeeId = null;
    public $calendar_id = null;
    
    protected $listeners = [
        'refreshEmployees' => '$refresh',
    ];
    
    public function openCalendarModal($employeeId)
    {
        $this->selectedEmployeeId = $employeeId;

        if ($this->calendars->count() == 1) {
            $this->calendar_id = $this->calendars->first()->id;
        } else {
            $this->calendar_id = null;
        }
    }
 

    public function applyCalendar()
    {
        if (!$this->selectedEmployeeId || !$this->calendar_id) return;

        Employee::where('id', $this->selectedEmployeeId)
            ->update([
                'calendar_id' => $this->calendar_id,
            ]);

        $this->dispatch('show-toast', message: 'Calendar Applied Successfully');

        // close modal
        $this->dispatch('close-calendar-modal');

        // refresh list
        $this->reset('selectedEmployeeId', 'calendar_id');
    }


    // ✅ Persist in URL
    protected $queryString = [
        'perPage' => ['except' => 10],
        'page' => ['except' => 1],
        'search' => ['except' => ''],
        'departmentFilter' => ['except' => ''],
        'designationFilter' => ['except' => ''],
    ];

    public function updatedDepartmentFilter()
    {
        $this->resetPage();
    }

    public function updatedDesignationFilter()
    {
        $this->resetPage();
    }

    // ✅ Reset page when search changes
    public function updatedSearch()
    {
        $this->resetPage();
    }

    // already exists
    public function updatedPerPage()
    {
        $this->resetPage();
    }

    public function mount($lawyer = null)
    {
        $this->calendars = LeaveCalendar::all();
        $this->departments = Parameter::where('tag', 'department')->get();
        $this->designations = Parameter::where('tag', 'designation')->get();

        if (request()->has('tab')) {
            $this->activeTab = request('tab');
        }
        $this->lawyer = $lawyer;
        $this->flag = request()->get('flag', 'false');
    }

    public function delete($id)
    {
        Employee::findOrFail($id)->delete();
        $this->dispatch('show-toast', message: 'Employee Deleted Successfully.');
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            // toggle direction
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            // new field → default asc
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }

        $this->resetPage(); // important
    }

    public function render()
    {
 

        $query = Employee::with(['department', 'designation']); // base query

        if (!empty($this->lawyer)) {
            $query->whereHas('designation', function ($q) {
                $q->where('name', $this->lawyer);
            });
        }

        // 🔍 Search
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%')
                ->orWhere('code', 'like', '%' . $this->search . '%')
                ->orWhereHas('department', function ($q2) {
                    $q2->where('name', 'like', '%' . $this->search . '%');
                })
                ->orWhereHas('designation', function ($q3) {
                    $q3->where('name', 'like', '%' . $this->search . '%');
                });
            });
        }

        // 🎯 Department Filter
        if ($this->departmentFilter) {
            $query->where('department_id', $this->departmentFilter);
        }

        // 🎯 Designation Filter
        if ($this->designationFilter) {
            $query->where('designation_id', $this->designationFilter);
        }

        // 🔼 Sorting
        $query->orderBy($this->sortField, $this->sortDirection);

        $employees = $query->paginate($this->perPage);


        $departments = \App\Models\Parameter::where('tag', 'department')->get();
        $designations = \App\Models\Parameter::where('tag', 'designation')->get();

        return view('livewire.employee.employee-crud', [
            'employees' => $employees,
            'departments' => $departments,
            'designations' => $designations,
        ])->layout('layouts.app', [
            'title' => 'Employee',
            'sub_title' => 'Employee List'
        ]);
    }


    public function edit($id)
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
            $this->updateMode = true;
          //  $this->dispatch('open-edit-box');
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
    
        if ($this->employee_id) {
            $employee = Employee::findOrFail($this->employee_id);
            $employee->update([
                'name' => $this->name,
                'phone' => $this->phone,
                'email' => $this->email,
                'department_id' => $this->department_id,
                'designation_id' => $this->designation_id,
            ]);
        }else{
            
            $empcode = DB::select("SELECT fnc_get_code(0) as code")[0]->code;

            $employee = Employee::create([
                'name' => $this->name,
                'phone' => $this->phone,
                'email' => $this->email,
                'department_id' => $this->department_id,
                'designation_id' => $this->designation_id,
                'code' => $empcode,
            ]);
        }
 
        $this->dispatch('show-toast', message: $this->employee_id ? 'Employee Updated Successfully' : 'Employee Created Successfully');

        $this->resetInputFields();

        $this->updateMode = false;
    }


    private function resetInputFields()
    {
        $this->employee_id = null;
        $this->name = '';
        $this->phone = '';
        $this->email = '';
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