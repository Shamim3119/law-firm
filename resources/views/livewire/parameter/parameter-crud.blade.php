<div>

<!-- Tabs -->
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

<div class='row'>
    <div class='col-6'>


            <button style='display:block;' onclick="fadeToggle('btnNew', 'boxNew', 'boxView')" id="btnNew" class="btn btn-sm btn-primary" >
               New {{ ucfirst($activeTab) }}  
            </button>
            <br />   
 

        <div style='display:none;' id='boxNew' class="card card-primary card-outline mb-4">
            <div class="card-header">
                <div class="card-title">{{ ucfirst($activeTab) }} Update</div>
            </div>
            <form wire:submit.prevent="store" wire:key="parameter-form-{{ $updateMode ? 'edit' : 'create' }}">
                <div class="card-body">
                    <div class="mb-3">
                        <label class="mb-2">{{ ucfirst($activeTab) }} :</label>
                
                        <input
                            type="text"
                            class="form-control"
                            placeholder="Name"
                            wire:model.defer="name"
                        >

                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="card-footer">
                    <div class="mb-3">
                        @if($updateMode)
                            <button type="submit" class="btn btn-primary">Update</button>
                            <button type="button" wire:click="cancel" class="btn btn-secondary">Cancel</button>
                        @else
                            <button type="submit" class="btn btn-success">Save</button>
                            <button type="button" wire:click="cancel" class="btn btn-secondary">Cancel</button>
                        @endif
                    </div>
                </div>
            </form>
        </div>
     
 
        <div style='opacity:1' id='boxView'  class="card card-primary card-outline mb-4">
            <div class="card-header">
                <div class="card-title">{{ ucfirst($activeTab) }} List</div>
            </div>
            <div class="card-body">

                <table class="table table-bordered mt-3">

                    <thead>
                        <tr>
                            <th style="width:2%">SL</th>
                            <th>Name</th>
                            <th style="text-align:center; width:150px;">Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($parameters as $parameter)
                            <tr wire:key="parameter-row-{{ $parameter->id }}">

                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $parameter->name }}</td>

                                <td style="text-align:center">
                                    <button onclick="fadeToggle('btnNew', 'boxNew', 'boxView')"   
                                        wire:click="edit({{ $parameter->id }})"
                                        class="btn btn-primary btn-sm"
                                    >
                                        Edit
                                    </button>

                                    <button
                                        wire:click="delete({{ $parameter->id }})"
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
        </div>
    </div>
</div>

{!! MyHelper::get_toast_dispatch() !!}


<script> 
document.addEventListener('livewire:init', () => {
    Livewire.on('open-edit-box', () => {
        fadeToggle('btnNew', 'boxNew', 'boxView');
    });
});
 
</script>
</div>