<div>
    <form wire:submit.prevent="save" class="p-4">
        
        <div class="mb-3">
            <label>Appointment Status</label>
            <select class="form-select" wire:model="status_id">
                <option selected  value="">Choose...</option>
                <option value="3">Accepted</option>
                <option value="4">Rejected</option>
            </select>
          @error('status_id') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <label>Note</label>
            <textarea class="form-control" wire:model="note"></textarea>
            @error('note') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn btn-sm btn-success"> Update</button>
    </form>
</div>


<script>
    window.addEventListener('closeModal', () => {
        const modal = bootstrap.Modal.getInstance(document.getElementById('ModalStatus'));
        if (modal) {
            modal.hide();
        }
    });
</script>