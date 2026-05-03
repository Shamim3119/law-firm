<div>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>


    <div class='row'>
        <div class='col-12 p-4'>
            <!-- Form -->
            <form wire:submit.prevent="store">
                <div class="mb-3">
                    <div class="row">
                        <div class="col-4">
                            <label>Date</label>
                            <input type="text" id="date" class="form-control datepicker" placeholder="Select date" wire:model="start_date">
                            @error('start_date') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-4">
                            <label>Start Time</label>
                            <input type="time" class="form-control" wire:model="start_time">
                            @error('start_time') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="col-4">
                            <label>End Time</label>
                            <input type="time" class="form-control" wire:model="end_time">
                            @error('end_time') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                
                <div class="mb-3">
                    <label>Appointment Details</label>
                    <textarea class="form-control" wire:model="details"></textarea>
                    @error('details') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    @if($updateMode)
                        <button type="submit" class="btn btn-sm btn-primary">Update</button>
                        <button type="button" wire:click="cancel" class="btn btn-sm btn-secondary">Cancel</button>
                    @else
                        <button type="submit" class="btn btn-sm  btn-success">Save</button>
                    @endif
                </div>
            </form>

            <br>
            <!-- List -->
            <h5 class="mt-3 text-capitalize">Appointment Details</h5>
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th style='width:2%'>SL</th>
                        <th style='width:15%'>Date</th>
                        <th style='width:15%'>Start</th>
                        <th style='width:15%'>End</th>
                        <th>Details</th>
                        <th style="text-align: center; width: 150px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach($appointments as $appointment)
                        <tr wire:key="param-{{ $appointment->id }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ \Carbon\Carbon::parse($appointment->start_date)->format('d M, Y') }}</td>
                            <td>{{ \Carbon\Carbon::parse($appointment->start_time)->format('g:i A') }}</td>
                            <td>{{ \Carbon\Carbon::parse($appointment->end_time)->format('g:i A') }}</td>
                            <td>{{ $appointment->details }}</td>
                            <td style="text-align: center">
                                <button wire:click="edit({{ $appointment->id }})" class="btn btn-primary btn-sm">Edit</button>
                                <button wire:click="delete({{ $appointment->id }})" class="btn btn-danger btn-sm">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
 
        const modal = document.getElementById('ModalLive');

        modal.addEventListener('hidden.bs.modal', function () {
            Livewire.dispatch('refreshAppointments');
        });

        flatpickr("#date", {
            dateFormat: "Y-m-d"
        });
    
        flatpickr("#datetime", {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            time_24hr: true
        });

 
    </script>

    {!! MyHelper::get_toast_dispatch() !!}

</div>