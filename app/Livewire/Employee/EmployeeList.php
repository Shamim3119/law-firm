<?php

namespace App\Livewire\Employee;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Employee;

class EmployeeList extends Component
{
    use WithPagination;

    public $sortField = 'id';
    public $sortDirection = 'asc';
    protected $paginationTheme = 'bootstrap';
    public $activeTab = 'employees';
    public $perPage = 10;
    public $search = ''; // ✅ NEW

    public $departmentFilter = '';
    public $designationFilter = '';

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

    public function mount()
    {
        if (request()->has('tab')) {
            $this->activeTab = request('tab');
        }
    }

    public function delete($id)
    {
        Employee::findOrFail($id)->delete();
        session()->flash('message', 'Employee Deleted Successfully.');
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
        $query = Employee::with(['department', 'designation']);

        // 🔍 Search
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%')
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

        return view('livewire.employee.employee-list', [
            'employees' => $employees,
            'departments' => $departments,
            'designations' => $designations,
        ])->layout('layouts.app', [
            'title' => 'Employee',
            'sub_title' => 'Employee List'
        ]);
    }
}