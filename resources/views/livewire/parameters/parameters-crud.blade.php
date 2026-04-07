<div>

<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="btn btn-danger btn-sm">Logout</button>
</form>


    <h2>Client Management</h2>

    @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <form wire:submit.prevent="store">
        <div class="mb-3">
            <input type="text" class="form-control" placeholder="Name" wire:model="name">
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <input type="text" class="form-control" placeholder="Tag" wire:model="tag">
            @error('tag') <span class="text-danger">{{ $message }}</span> @enderror
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

     

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Name</th>
                <th>Tag</th>
                <th style='text-align: center'>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($parameters as $parameter)
                <tr>
                    <td>{{ $parameter->name }}</td>
                    <td>{{ $parameter->tag }}</td>
                    <td style='text-align: center'>
                        <button wire:click="edit({{ $parameter->id }})" class="btn btn-primary btn-sm">Edit</button>
                        <button wire:click="delete({{ $parameter->id }})" class="btn btn-danger btn-sm">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

 