<?php

namespace App\Livewire\LeaveInfo;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;
use App\Models\Leave;
use App\Models\Parameter;

class LeaveInfoCrud extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $from_date_filter = '';
    public $to_date_filter = '';
    public $perPage = 10;

    public $sortField = 'leaves.id';
    public $sortDirection = 'desc';

    public $flag = true;
    public $updateMode = false;
    public $activeTab = 'leave-info';

    public $leave_id;
    public $type_id;
    public $leave_from;
    public $leave_to;
    public $remarks;

    public $leave_types;

    public $employee;
    public $employee_id;

    protected $queryString = [
        'search' => ['except' => ''],
        'perPage' => ['except' => 10],
        'page' => ['except' => 1],
    ];
    
    #[On('employeeSelected')]
    public function employeeSelected($data)
    {
        $this->employee = $data['name'];
        $this->employee_id = $data['id'];
    }

    public function edit($id)
    {
        if ($id) {
            $leave = Leave::findOrFail($id);
            $this->leave_id = $leave->id;
            $this->type_id =  $leave->type_id;
            $this->employee_id =  $leave->employee_id;
            $this->employee = $leave->employee->name;
            $this->leave_from = $leave->leave_from;
            $this->leave_to =  $leave->leave_to;
            $this->remarks =  $leave->remarks;
            $this->updateMode = true;
        }
    }

    public function render()
    {
        $search = trim($this->search);

        $query = Leave::query()
            ->select(
                'leaves.*',
                'employees.name as employee_name',
                'employees.code as employee_code',
                'dept.name as department_name',
                'desig.name as designation_name',
                'lt.name as leave_type_name'
            )
            ->leftJoin('employees', 'employees.id', '=', 'leaves.employee_id')
            ->leftJoin('parameters as dept', 'dept.id', '=', 'employees.department_id')
            ->leftJoin('parameters as desig', 'desig.id', '=', 'employees.designation_id')
            ->leftJoin('parameters as lt', 'lt.id', '=', 'leaves.type_id');

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('employees.name', 'like', "%{$search}%")
                ->orWhere('employees.code', 'like', "%{$search}%");
            });
        }

        if ($this->from_date_filter) {
            $query->whereDate('leaves.leave_from', '>=', $this->from_date_filter);
        }

        if ($this->to_date_filter) {
            $query->whereDate('leaves.leave_to', '<=', $this->to_date_filter);
        }

        $query->orderBy($this->sortField, $this->sortDirection);

        $leaves = $query->paginate($this->perPage);

        return view('livewire.leave-info.leave-info-crud', compact('leaves'))
            ->layout('layouts.app', [
                'title' => 'Leave Info',
                'sub_title' => 'Leaves List'
            ]);
    }


    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            // toggle asc/desc
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }

        $this->resetPage();
    }

    public function resetFilters()
    {
        $this->search = '';
        $this->from_date_filter = '';
        $this->to_date_filter = '';
        $this->resetPage();
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedFromDateFilter()
    {
        $this->resetPage();
    }

    public function updatedToDateFilter()
    {
        $this->resetPage();
    }

    public function updatedPerPage()
    {
        $this->resetPage();
    }
 

    public function mount($lawyer = null)
    { 
        $this->leave_types = Parameter::where('tag', 'leave-type')->get();

        if (request()->has('tab')) {
            $this->activeTab = request('tab');
        }
    }


    public function save()
    {
        $this->validate([
            'type_id' => 'required|integer',
            'employee_id' => 'required|integer',
            'leave_from' => 'required|date_format:Y-m-d',
            'leave_to'   => 'required|date_format:Y-m-d',
        ]);
    
        if ($this->leave_id) {
            $leave = Leave::findOrFail($this->leave_id);
            $leave->update([
                'type_id' => $this->type_id,
                'employee_id' => $this->employee_id,
                'leave_from' => $this->leave_from,
                'leave_to' => $this->leave_to,
                'remarks' => $this->remarks,
            ]);
        }else{
        
            $leave = Leave::create([
                'type_id' => $this->type_id,
                'employee_id' => $this->employee_id,
                'leave_from' => $this->leave_from,
                'leave_to' => $this->leave_to,
                'remarks' => $this->remarks,
            ]);
        }
 
        $this->dispatch('show-toast', message: $this->leave_id ? 'Leave Info Updated Successfully' : 'Leave Info Created Successfully');

        $this->resetInputFields();

        $this->updateMode = false;
    }


    public function resetInputFields()
    {
        $this->type_id = '';
        $this->employee_id = '';
        $this->employee = '';
        $this->leave_from = '';
        $this->leave_to = '';
        $this->remarks = '';
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
        $this->resetPage(); 
 
    }
}
