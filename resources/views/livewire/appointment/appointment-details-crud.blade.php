<div>


<br> 
 
    <!-- Form -->
    <form wire:submit.prevent="store">
        <div class="mb-3">
            <div class="row">
                <div class="col-6">
                    <label>Appointment Date</label>
                    <input type="text" id="date" class="form-control datepicker" placeholder="Select date" wire:model="appointment_date">
                    @error('appointment_date') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-3">
                    <label>Appointment Start Time</label>
                    <input type="time" class="form-control" wire:model="appointment_start_time">
                    @error('appointment_start_time') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-3">
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

        <div class="mb-3">
            @if($updateMode)
                <button type="submit" class="btn btn-primary">Update</button>
                <button type="button" wire:click="cancel" class="btn btn-secondary">Cancel</button>
            @else
                <button type="submit" class="btn btn-success">Save</button>
            @endif
        </div>
    </form>

    <!-- List -->
    <h4 class="mt-3 text-capitalize">Appointment Details</h4>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Date</th>
                <th>Start</th>
                <th>End</th>
                <th>Details</th>
                <th style="text-align: center; width: 150px;">Action</th>
            </tr>
        </thead>
        <tbody>
            
 
            @foreach($appointments as $appointment)
                <tr wire:key="param-{{ $appointment->id }}">
                    <td>{{ $appointment->appointment_date }}</td>
                    <td>{{ $appointment->appointment_start_time }}</td>
                    <td>{{ $appointment->appointment_end_time }}</td>
                    <td>{{ $appointment->appointment_details }}</td>
                    <td style="text-align: center">
                        <button wire:click="edit({{ $appointment->id }})" class="btn btn-primary btn-sm">Edit</button>
                        <button wire:click="delete({{ $appointment->id }})" class="btn btn-danger btn-sm">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

<script>
 
    const modal = document.getElementById('ModalLive');

    modal.addEventListener('hidden.bs.modal', function () {
        Livewire.dispatch('refreshAppointments');
    });
 
 
</script>
 

{!! MyHelper::get_toast_dispatch() !!}
 
</div>