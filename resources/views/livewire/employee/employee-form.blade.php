<div> <!-- single root -->
    <div class='row'>
        <div class='col-12'>

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

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1" wire:model="inactive">
                            <label class="form-check-label" for="exampleCheck1">Inactive</label>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-6">
                                <label>Enroll ID :</label>
                                <input type="text" class="form-control" wire:model="enroll_id" >
                                @error('enroll_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-6">
                                <label>Name :</label>
                                <input type="text" class="form-control" wire:model="name" >
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-6">
                                <label>Father's Name :</label>
                                <input type="text" class="form-control" wire:model="father_name" >
                                @error('father_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-6">
                                <label>Mother's Name :</label>
                                <input type="text" class="form-control" wire:model="mother_name" >
                                @error('mother_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label>Phone :</label>
                                <input type="text" class="form-control" wire:model="personal_phone">
                                @error('personal_phone') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>


                            <div class="col-6">
                                <label>Email :</label>
                                <input type="email" class="form-control" wire:model="personal_email">
                                @error('personal_email') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-6">
                                <label>Department :</label>
                                <select class="form-select" wire:model="department_id">
                                    <option selected value="">Select Department</option>
                                        @foreach($departments as $dept)
                                            <option value="{{ $dept->id }}">{{ $dept->name }}</option>
                                        @endforeach
                                </select>
                                @error('department_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="col-6">
                                <label>Designation :</label>
                                <select class="form-select" wire:model="designation_id">
                                    <option selected value="">Select Designation</option>
                                        @foreach($designations as $designation)
                                            <option value="{{ $designation->id }}">{{ $designation->name }}</option>
                                        @endforeach
                                </select>
                                @error('designation_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
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



<div class="modal fade" id="ModalCalender" wire:ignore.self tabindex="-1">
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
                        <option value="">Select Calendar</option>
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
                             >
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






