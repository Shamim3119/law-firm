<div>

 

@if($flag == 'true')
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link {{ $activeTab == 'employees' ? 'active' : '' }}" 
               href="{{ route('employee.index', ['tab' => 'employees']) }}">
               Employees
            </a>
        </li>
    </ul>

    <br>

    <a href="{{ route('employee.create') }}" class="btn btn-primary mb-3">
        Add Employee
    </a>
@endif

    <!-- Per Page -->
<div class="row mb-2">

    <!-- Search -->
    <div class="col-md-3">
        <input 
            type="text" 
            wire:model.live="search" 
            class="form-control" 
            placeholder="Search..."
        >
    </div>

    <!-- Department Filter -->
    <div class="col-md-3">
        <select wire:model.live="departmentFilter" class="form-control">
            <option value="">All Departments</option>
            @foreach($departments as $dept)
                <option value="{{ $dept->id }}">{{ $dept->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Designation Filter -->
    <div class="col-md-3">
        <select wire:model.live="designationFilter" class="form-control">
            <option value="">All Designations</option>
            @foreach($designations as $des)
                <option value="{{ $des->id }}">{{ $des->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Per Page -->
    <div class="col-md-3">
        <select wire:model.live="perPage" class="form-control">
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="30">30</option>
            <option value="40">40</option>
            <option value="50">50</option>
        </select>
    </div>

</div>

    <!-- Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>
                  SL
              </th>
                <th wire:click="sortBy('code')" style="cursor:pointer;">
                    ID @include('sort-icon', ['field' => 'code'])
                </th>

                <th wire:click="sortBy('name')" style="cursor:pointer;">
                    Name @include('sort-icon', ['field' => 'name'])
                </th>
            @if($flag == 'true')
                <th wire:click="sortBy('email')" style="cursor:pointer;">
                    Email @include('sort-icon', ['field' => 'email'])
                </th>

                <th wire:click="sortBy('phone')" style="cursor:pointer;">
                    Phone @include('sort-icon', ['field' => 'phone'])
                </th>
            @endif
                <th>Department</th>
                <th>Designation</th>
                <th style='text-align:center;'>Action</th>
            </tr>
        </thead>

        <tbody>
            @forelse($employees as $employee)
            <tr wire:key="employee-{{ $employee->id }}">
                <td>{{ $loop->iteration  }}</td>
                <td>{{ $employee->code }}</td>
                <td>{{ $employee->name }}</td>
            @if($flag == 'true')
                <td>{{ $employee->phone }}</td>
                <td>{{ $employee->email }}</td>
            @endif
                <td>{{ $employee->department->name ?? '-' }}</td>
                <td>{{ $employee->designation->name ?? '-' }}</td>
                <td align='center'>
                    @if($flag == 'true')
                        <a href="{{ route('employee.edit', $employee->id) }}" 
                        class="btn btn-sm btn-warning">Edit</a>

                        <button 
                            wire:click="delete({{ $employee->id }})"
                            onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
                            class="btn btn-danger btn-sm">
                            Delete
                        </button>
                    @else
                        <button 
                            wire:click="$dispatch('EmployeeSelected', { data: { id: {{ $employee->id }}, name: '{{ $employee->name }}' } })"
                            class="btn btn-sm btn-warning">
                            Add
                        </button>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center">No employees found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <!-- Pagination -->
    <div>
        {{ $employees->links() }}
    </div>

    <script>
    window.addEventListener('EmployeeSelected', () => {
        let modalEl = document.getElementById('ModalLive');
        let modal = bootstrap.Modal.getInstance(modalEl);

        if (modal) {
            modal.hide();
        }

        // 👇 IMPORTANT: cleanup leftover backdrop
        setTimeout(() => {
            document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
            document.body.classList.remove('modal-open');
            document.body.style.removeProperty('padding-right');
        }, 300);
    });
</script>
</div>