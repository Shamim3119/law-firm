<div>
 

<br> 
 
    <!-- Form -->
    <form wire:submit.prevent="store">
 
        <div class="mb-3">
            <label>Court No</label>
            <input class="form-control" wire:model="court_no" /> 
            @error('court_no') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

                
        <div class="mb-3">
            <label>Court Name</label>
            <input class="form-control" wire:model="name" /> 
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
                
        <div class="mb-3">
            <label>Chief Justice</label>
            <input class="form-control" wire:model="chief_justice" /> 
            @error('chief_justice') <span class="text-danger">{{ $message }}</span> @enderror
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
    <h4 class="mt-3 text-capitalize">Courts Details</h4>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>SL</th>
                <th>Court No</th>
                <th>Court Name</th>
                <th>Chief Justice</th>
                <th style="text-align: center; width: 150px;">Action</th>
            </tr>
        </thead>
        <tbody>
            

 
            @foreach($courts as $court)
                <tr wire:key="param-{{ $court->id }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $court->court_no }}</td>
                    <td>{{ $court->name }}</td>
                    <td>{{ $court->chief_justice }}</td>
                    <td style="text-align: center">
                        <button wire:click="edit({{ $court->id }})" class="btn btn-primary btn-sm">Edit</button>
                        <button wire:click="delete({{ $court->id }})" class="btn btn-danger btn-sm">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
 
</div>
