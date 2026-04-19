<div class='m-3'>

<!-- Form -->
<form wire:submit.prevent="store" wire:key="court-form-{{ $court_id }}">



    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="exampleCheck1" wire:model="inactive">
        <label class="form-check-label" for="exampleCheck1">Inactive</label>
    </div>

    <div class="mb-3">
        <label>Court No</label>
        <input
            class="form-control"
            wire:model="court_no"
            wire:key="court-no-{{ $court_id }}"
        />
        @error('court_no')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-3">
        <label>Court Name</label>
        <input
            class="form-control"
            wire:model="name"
            wire:key="court-name-{{ $court_id }}"
        />
        @error('name')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-3">
        <label>Chief Justice</label>
        <input
            class="form-control"
            wire:model="chief_justice"
            wire:key="court-justice-{{ $court_id }}"
        />
        @error('chief_justice')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-3">
        @if($updateMode)
            <button type="submit" class="btn btn-sm btn-primary">Update</button>
            <button type="button" wire:click="cancel" class="btn btn-sm btn-secondary">Cancel</button>
        @else
            <button type="submit" class="btn btn-sm btn-success">Save</button>
        @endif
    </div>

</form>

<br>
<!-- List -->
<h5 class="mt-3 text-capitalize">Courts Details</h5>

<table class="table table-bordered mt-3">
    <thead>
        <tr>
            <th style='width:2%;'>SL</th>
            <th>Court No</th>
            <th>Court Name</th>
            <th>Chief Justice</th>
            <th style="text-align: center; width: 150px;">Action</th>
        </tr>
    </thead>

    <tbody>
        @foreach($courts as $court)

            <tr wire:key="court-row-{{ $court->id }}">
                <td>{{ $loop->iteration }}</td>
                <td class="{{ $court->inactive ? 'text-danger' : '' }}" >{{ $court->court_no }}</td>
                <td class="{{ $court->inactive ? 'text-danger' : '' }}">{{ $court->name }}</td>
                <td class="{{ $court->inactive ? 'text-danger' : '' }}">{{ $court->chief_justice }}</td>
                <td style="text-align: center">
                    <button
                        wire:click="edit({{ $court->id }})"
                        class="btn btn-primary btn-sm"
                    >
                        Edit
                    </button>

                    <button
                        wire:click="delete({{ $court->id }})"
                        class="btn btn-danger btn-sm"
                    >
                        Delete
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

</div>