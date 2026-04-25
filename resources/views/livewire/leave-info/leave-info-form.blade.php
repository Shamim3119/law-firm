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
                            <div class="row">
                                <div class="col-10">
                                    <label>Employee</label>
                                    <input type="text" readonly class="form-control" wire:model="employee">
                                    @error('employee') <span class="text-danger">{{ $message }}</span> @enderror
                                    <input type="hidden" wire:model="employee_id">

                                </div>
                                <div class="col-2"><br>
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#ModalLiveEmp" class="btn btn-warning">...</button>
                                </div>
                            </div>
                        </div>


                        <div class="mb-3">
                            <label>Leave Type :</label>
                            <select class="form-select"  wire:model="type_id">
                                    @foreach($leave_types as $leave_type)
                                        <option value="{{ $leave_type->id }}">{{ $leave_type->name }}</option>
                                    @endforeach
                            </select>
                            @error('type_id') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
 




           
                        <div class="mb-3">
                            <div class="row">
                                <div class="col-6">
                                    <label>Leave From</label>
                                    <div wire:ignore>
                                        <input type="text" id="from_date" class="form-control" wire:model="leave_from">
                                    </div>
                                    @error('leave_from') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                <div class="col-6">
                                    <label>Leave To</label>
                                    <div wire:ignore>
                                        <input type="text" id="to_date" class="form-control" wire:model="leave_to">
                                    </div>
                                    @error('leave_to') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label>Remarks :</label>
                            <input type="text" class="form-control" wire:model="remarks" >
                            @error('remarks') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="m-3 d-flex justify-content-center">
                            @if($leave_id)
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

<script>
flatpickr("#from_date", {
    dateFormat: "Y-m-d",
    onChange: function(selectedDates, dateStr) {
        @this.set('leave_from', dateStr);
    }
});

flatpickr("#to_date", {
    dateFormat: "Y-m-d",
    onChange: function(selectedDates, dateStr) {
        @this.set('leave_to', dateStr);
    }
});
</script>


<div class="modal fade modal-lg" id="ModalLiveEmp" tabindex="-1" aria-labelledby="ModalLiveLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="ModalLiveLabel">List of Employee</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @livewire('employee.employee-crud')  
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

