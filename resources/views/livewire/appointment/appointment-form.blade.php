<div>  

 

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>


    <form wire:submit.prevent="save">
        <div class="mb-3">
            <label>Titel</label>
            <input type="text" class="form-control" wire:model="title">
            @error('title') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label>Descriptions</label>
            <input type="text" class="form-control" wire:model="descriptions">
            @error('descriptions') <span class="text-danger">{{ $message }}</span> @enderror
        </div>


        <div class="mb-3">
            <label>Appointment Type</label>
            <select class="form-select" wire:model="appointment_type_id">
                <option selected="" disabled="" value="">Choose...</option>
                    @foreach($appointment_types as $appointment_type)
                        <option value="{{ $appointment_type->id }}">{{ $appointment_type->name }}</option>
                    @endforeach
            </select>
            @error('appointment_type_id') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
 
        <div class="mb-3">
            <div class="row">
                <div class="col-10">
                    <label>Lawyer</label>
                    <input type="text" readonly class="form-control" wire:model="employee">
                    @error('employee') <span class="text-danger">{{ $message }}</span> @enderror
                    <input type="hidden" wire:model="employee_id">

                </div>
                  <div class="col-2">
                    <button type="button" data-bs-toggle="modal" data-bs-target="#ModalLiveEmp" class="btn btn-warning">...</button>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <div class="row">
                <div class="col-10">
                    <label>Client</label>
                    <input type="text" readonly class="form-control" wire:model="client">
                    @error('client') <span class="text-danger">{{ $message }}</span> @enderror
                    <input type="hidden" wire:model="client_id">
                </div>
                 <div class="col-2">
                    <button type="button" data-bs-toggle="modal" data-bs-target="#ModalLive" class="btn btn-warning">...</button>
                </div>
            </div>
        </div>  

        <div class="mb-3">
            <div class="row">
                <div class="col-3">
                    <label>Appointment Date</label>
                    <input type="text" id="date" class="form-control" placeholder="Select date" wire:model="appointment_date">
                    @error('appointment_date') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-2">
                    <label>Appointment Start Time</label>
                    <input type="time" class="form-control" wire:model="appointment_start_time">
                    @error('appointment_start_time') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-2">
                    <label>Appointment End Time</label>
                    <input type="time" class="form-control" wire:model="appointment_end_time">
                    @error('appointment_end_time') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
      </div>
        
        <div class="mb-3">
            <label>Appointment Details</label>
            <textarea class="form-control" wire:model="appointment_details"></textarea>
            @error('appointment_details') <span class="text-danger">{{ $message }}</span> @enderror
        </div>



        <button type="submit" class="btn btn-success">{{ $appointment_id ? 'Update' : 'Create' }}</button>
        <a href="{{ route('appointment.index', ['tab' => 'appointments', 'flag' => 'true']) }}" class="btn btn-secondary">Back</a>
    </form>
 

 

    <div class="modal fade modal-lg" id="ModalLive" tabindex="-1" aria-labelledby="ModalLiveLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ModalLiveLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @livewire('client.client-list')  
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


        <div class="modal fade modal-lg" id="ModalLiveEmp" tabindex="-1" aria-labelledby="ModalLiveLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ModalLiveLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @livewire('employee.employee-list')  
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

<script>
    flatpickr("#date", {
        dateFormat: "Y-m-d"
    });
 
    flatpickr("#datetime", {
        enableTime: true,
        dateFormat: "Y-m-d H:i",
        time_24hr: true
    });
</script>
 

</div>




