<div> <!-- single root -->

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

 

        <button type="submit" class="btn btn-success">{{ $case_id ? 'Update' : 'Create' }}</button>
        <a href="{{ route('cases.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>