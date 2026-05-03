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
        @include('livewire.employee.employee-form')
    @endif

    
    <div @if($updateMode) style="display:none;" @endif id='boxView' class="card card-primary card-outline mb-4">
        <div class="card-header">
            <div class="card-title">{{ ucfirst($activeTab) }} List</div>
        </div>
        <div class="card-body">
                <!-- Per Page -->
            <div class="row mb-2">
                <!-- Search -->
                <div class="col-md-3">
                    <input 
                        type="text" 
                        wire:model.live="search" 
                        class="form-control" 
                        placeholder="Search...">
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
                            <th>Department</th>
                            <th>Designation</th>
                        @if($flag == 'true')
                            <th wire:click="sortBy('email')" style="cursor:pointer;">
                                Email @include('sort-icon', ['field' => 'email'])
                            </th>
                            <th wire:click="sortBy('phone')" style="cursor:pointer;">
                                Phone @include('sort-icon', ['field' => 'phone'])
                            </th>
                            <th style='text-align:center;'>Attendance</th>
                            <th style='text-align:center;'>Leave</th>
                            <th style='text-align:center;'>Calender</th>
                        @endif


                            <th style='text-align:center;'>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($employees as $employee)
                        <tr wire:key="employee-{{ $employee->id }}">
                            <td class="{{ $employee->inactive ? 'text-danger' : '' }}" >{{ $loop->iteration  }}</td>
                            <td class="{{ $employee->inactive ? 'text-danger' : '' }}" >{{ $employee->code }}</td>
                            <td class="{{ $employee->inactive ? 'text-danger' : '' }}" >{{ $employee->name }}</td>
                            <td class="{{ $employee->inactive ? 'text-danger' : '' }}" >{{ $employee->department->name ?? '-' }}</td>
                            <td class="{{ $employee->inactive ? 'text-danger' : '' }}" >{{ $employee->designation->name ?? '-' }}</td>

                        @if($flag == 'true')
                            <td class="{{ $employee->inactive ? 'text-danger' : '' }}" >{{ $employee->email }}</td>
                            <td class="{{ $employee->inactive ? 'text-danger' : '' }}" >{{ $employee->phone }}</td>
                            <td style='text-align:center;'>
                                <button 
                                wire:click="$dispatch('setEmployeeId', { data: { id: {{ $employee->id }} } })"
                                data-bs-toggle="modal"
                                data-bs-target="#ModalAttendance"
                                class="btn btn-sm btn-{{ $employee->attendance_id == 0 ? 'danger' : 'success' }}">{{ $employee->attendance->name ?? '--' }}
                                </button>
                            </td>
                            <td style='text-align:center;'>
      
                                <button
                   
                                    wire:click="$dispatch('setEmployeeId', { data: { id: {{ $employee->id }} } })"

           
                                    data-bs-toggle="modal"
                                    data-bs-target="#ModalLeave"
                                    class="btn btn-sm btn-{{ $employee->leave_id == 0 ? 'danger' : 'success' }}">
                                    {{ $employee->leave->name ?? '--' }}
                                </button>


                            </td>
                            <td style='text-align:center;'>
                                <button
                                    wire:click="openCalendarModal({{ $employee->id }})"
                                    data-bs-toggle="modal"
                                    data-bs-target="#ModalCalender"
                                    class="btn btn-sm btn-{{ $employee->calendar_id == 0 ? 'danger' : 'success' }}">
                                    {{ $employee->calendar->title ?? '--' }}
                                </button>
                            </td>
                      
                        @endif
                            <td style='text-align:center;'>
                                @if($flag == 'true')
                                    <button   
                                        wire:click="edit({{ $employee->id }})"
                                        class="btn btn-primary btn-sm">
                                        Edit
                                    </button>

                                    <button 
                                        wire:click="delete({{ $employee->id }})"
                                        onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
                                        class="btn btn-danger btn-sm">
                                        Delete
                                    </button>
                                @else
                                    <button 
                                        wire:click="$dispatch('employeeSelected', { data: { id: {{ $employee->id }}, name: '{{ $employee->name }}' } })"
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
                 <br>
                <!-- Pagination -->
                <div>
                    {{ $employees->links() }}
                </div>

                <script>
 
                    document.addEventListener('livewire:init', () => {

                        // Calendar modal
                        Livewire.on('close-calendar-modal', () => {
                            let modal = bootstrap.Modal.getInstance(document.getElementById('ModalCalender'));
                            if (modal) modal.hide();
                            cleanupModal();
                        });

                        // Leave modal
                        Livewire.on('close-leave-modal', () => {
                            let modal = bootstrap.Modal.getInstance(document.getElementById('ModalLeave'));
                            if (modal) modal.hide();
                            cleanupModal();
                        });

                        // Attendance modal
                        Livewire.on('close-attendance-modal', () => {
                            let modal = bootstrap.Modal.getInstance(document.getElementById('ModalAttendance'));
                            if (modal) modal.hide();
                            cleanupModal();
                        });

                        function cleanupModal() {
                            setTimeout(() => {
                                document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
                                document.body.classList.remove('modal-open');
                                document.body.style.removeProperty('padding-right');
                            }, 300);
                        }

                    });
 
                    window.addEventListener('employeeSelected', () => {
                        let modalEl = document.getElementById('ModalLiveEmp');
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

            {!! MyHelper::get_toast_dispatch() !!}

        </div>
    </div>






<div class="modal fade modal-lg" id="ModalLeave" tabindex="-1" aria-labelledby="ModalLeaveLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="ModalLeaveLabel">Apply Leave Schedule</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body m-3">
 
                @livewire('leave-schedule.leave-schedule-crud')
            </div>                   
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-lg" id="ModalAttendance" tabindex="-1" aria-labelledby="ModalAttendanceLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="ModalAttendanceLabel">Apply Attendance Schedule</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body m-3">
 
                @livewire('attendance-schedule.attendance-schedule-crud')
            </div>                   
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
 
</div>