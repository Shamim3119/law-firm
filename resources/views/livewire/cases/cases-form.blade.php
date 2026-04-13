<div> <!-- single root -->

    <form wire:submit.prevent="save">

        <div class="mb-3">
            <div class="row">
                <div class="col-10">
                    <label>Appointment Code</label>
                    <input type="text" readonly class="form-control" wire:model="code">
                    @error('code') <span class="text-danger">{{ $message }}</span> @enderror
                    <input type="hidden" wire:model="appointment_id">

                </div>
                  <div class="col-2">
                    <button type="button" data-bs-toggle="modal" data-bs-target="#ModalLive" class="btn btn-warning">...</button>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <label>Total Charge Amount</label>
            <input type="text" class="form-control" wire:model="charge">
            @error('charge') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

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


        <button type="submit" class="btn btn-success">{{ $case_id ? 'Update' : 'Create' }}</button>
        <a href="{{ route('cases.index') }}" class="btn btn-secondary">Back</a>
    </form>


    <div class="modal fade modal-lg" id="ModalLive" tabindex="-1" aria-labelledby="ModalLiveLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ModalLiveLabel">Appointment Details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @livewire('appointment.appointment-list')  
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



</div>