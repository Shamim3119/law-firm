<div>  
 
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
            <div class="row">
                <div class="col-10">
                    <label>Employee</label>
                    <input type="text" readonly class="form-control" wire:model="employee">
                    @error('employee') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-2">
                    <button type="button" class="btn btn-warning">...</button>
                </div>
            </div>
        </div>

        <div class="mb-3">
            <div class="row">
                <div class="col-10">
                    <label>Client</label>
                    <input type="text" readonly class="form-control" wire:model="client">
                    @error('client') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                 <div class="col-2">
                    <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModalLive" class="btn btn-warning">...</button>
                </div>
            </div>
        </div>

    
        <button type="submit" class="btn btn-success">{{ $appointment_id ? 'Update' : 'Create' }}</button>
        <a href="{{ route('appointment.index') }}" class="btn btn-secondary">Back</a>
    </form>



<div class="modal fade" id="exampleModalLive" tabindex="-1" aria-labelledby="exampleModalLiveLabel" style="display: none;" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h1 class="modal-title fs-5" id="exampleModalLiveLabel">Modal title</h1><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div><div class="modal-body"><p>Woo-hoo, you’re reading this text in a modal!</p></div><div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button><button type="button" class="btn btn-primary">Save changes</button></div></div></div></div>
<div class="bd-example-snippet bd-code-snippet"> <div class="bd-example m-0 border-0"> 



</div>




