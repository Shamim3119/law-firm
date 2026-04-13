<div>
<ul class="nav nav-tabs">
    <li class="nav-item">
        <a href="{{ route('parameter.index', ['tab' => 'religion']) }}" 
           class="nav-link {{ $activeTab == 'religion' ? 'active' : '' }}">
           Religion
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('parameter.index', ['tab' => 'department']) }}" 
           class="nav-link {{ $activeTab == 'department' ? 'active' : '' }}">
           Department
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('parameter.index', ['tab' => 'designation']) }}" 
           class="nav-link {{ $activeTab == 'designation' ? 'active' : '' }}">
           Designation
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('parameter.index', ['tab' => 'appointment-type']) }}" 
           class="nav-link {{ $activeTab == 'appointment-type' ? 'active' : '' }}">
           Appointment Type
        </a>
    </li>
        <li class="nav-item">
        <a href="{{ route('parameter.index', ['tab' => 'gender']) }}" 
           class="nav-link {{ $activeTab == 'gender' ? 'active' : '' }}">
           Gender
        </a>
    </li>
</ul>

<br> 
 
    <!-- Form -->
    <form wire:submit.prevent="store">
        <div class="mb-3">
            <input type="text" class="form-control" placeholder="Name" wire:model.defer="name">
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
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
    <h4 class="mt-3 text-capitalize">{{ $activeTab }} List</h4>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th style='width:2%'>SL</th>
                <th>Name</th>
                <th style="text-align: center; width: 150px;">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($parameters as $parameter)
                <tr wire:key="param-{{ $parameter->id }}">
                    <td>{{ $loop->iteration  }}</td>
                    <td>{{ $parameter->name }}</td>
                    <td style="text-align: center">
                        <button wire:click="edit({{ $parameter->id }})" class="btn btn-primary btn-sm">Edit</button>
                        <button wire:click="delete({{ $parameter->id }})" class="btn btn-danger btn-sm">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

{!! MyHelper::get_toast_dispatch() !!}
 
</div>