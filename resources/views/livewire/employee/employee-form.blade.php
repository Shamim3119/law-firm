<div> <!-- single root -->
    <div class='row'>
        <div class='col-6'>

            <button 
                wire:click="create"
                class="mb-3 btn btn-sm btn-primary"
                @if($updateMode) style="display:none;" @endif
            >
                New {{ ucfirst($activeTab) }}
            </button>

            <form wire:submit.prevent="save">

 
                <div @if(!$updateMode) style="display:none;" @endif id='boxNew' class="card card-primary card-outline mb-4">

                    <div class="card-header">
                        <div class="card-title">{{ ucfirst($activeTab) }} Update</div>
                    </div> 
                    <div class="card-body m-3">

                        <div class="mb-3">
                            <label>Name :</label>
                            <input type="text" class="form-control" wire:model="name" >
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label>Phone :</label>
                            <input type="text" class="form-control" wire:model="phone">
                            @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label>Email :</label>
                            <input type="email" class="form-control" wire:model="email">
                            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label>Department :</label>
                            <select class="form-select" wire:model="department_id">
                                    @foreach($departments as $dept)
                                        <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                                    @endforeach
                            </select>
                            @error('department_id') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label>Designation :</label>
                            <select class="form-select" wire:model="designation_id">
                                    @foreach($designations as $designation)
                                        <option value="{{ $designation->id }}">{{ $designation->name }}</option>
                                    @endforeach
                            </select>
                            @error('designation_id') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="m-3 d-flex justify-content-center">
                            @if($employee_id)
                                <button type="submit" class="btn btn-success">Update</button>&nbsp;&nbsp;
                                <button type="button" wire:click="cancel" class="btn btn-secondary">Cancel</button>
                            @else
                                <button type="submit" class="btn btn-success">Save</button>&nbsp;&nbsp;
                                <button type="button" wire:click="cancel" class="btn btn-secondary">Cancel</button>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="ModalCalender" tabindex="-1" aria-labelledby="ModalCalendarLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="ModalCalendarLabel">Apply Calendar</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body m-3">
                <div class="mb-3">
                    <label>Leave Calendar :</label>
                    <select class="form-select" wire:model="calendar_id">
                            @foreach($calendars as $calendar)
                                <option value="{{ $calendar->id }}">
                                    {{ $calendar->year }} - {{ $calendar->title }}
                                </option>
                            @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <button type="button"
                            class="btn btn-sm btn-primary"
                            wire:click="applyCalendar"
                            data-bs-dismiss="modal">
                        Apply
                    </button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
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


