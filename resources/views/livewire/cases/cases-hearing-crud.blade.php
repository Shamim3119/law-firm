<div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<br> 
 
    <!-- Form -->
    <form wire:submit.prevent="store">


        <div class="mb-3">
            <label>Court</label>
            <select class="form-select" wire:model="court_id">
                <option selected="" disabled="" value="">Choose...</option>
                    @foreach($courts as $court)
                        <option value="{{ $court->id }}">{{ $court->court_no }} / {{ $court->name }}</option>
                    @endforeach
            </select>
            @error('court_id') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <div class="row">
                <div class="col-6">
                    <label>Hearing Date</label>
     <input type="text" class="form-control datepicker" wire:model="hearing_date">
                    @error('hearing_date') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-6">
                    <label>Hearing Time</label>
                    <input type="time" class="form-control" wire:model="hearing_time">
                    @error('hearing_time') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
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
    <h4 class="mt-3 text-capitalize">Hearing Details</h4>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>SL</th>
                <th>Court No</th>
                <th>Hearing Date</th>
                <th>Hearing Time</th>
                <th style="text-align: center; width: 150px;">Action</th>
            </tr>
        </thead>
        <tbody>
            
            @foreach($hearings as $hearing)
                <tr wire:key="param-{{ $hearing->id }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $hearing->court->name ?? '' }}</td>
                    <td>{{ $hearing->hearing_date }}</td>
                    <td>{{ $hearing->hearing_time }}</td>
 
                    <td style="text-align: center">
                        <button wire:click="edit({{ $hearing->id }})" class="btn btn-primary btn-sm">Edit</button>
                        <button wire:click="delete({{ $hearing->id }})" class="btn btn-danger btn-sm">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

<script>
document.addEventListener('livewire:init', () => {

    function initFlatpickr() {
        document.querySelectorAll('.datepicker').forEach(el => {
            flatpickr(el, {
                dateFormat: "Y-m-d"
            });
        });
    }

    initFlatpickr();

    Livewire.hook('message.processed', () => {
        initFlatpickr();
    });

});
</script>

 
</div>
