<div> <!-- single root -->
    @if(session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif

    <form wire:submit.prevent="save">
        <div class="mb-3">
            <label>Name</label>
            <input type="text" class="form-control" wire:model="name" >
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label>Phone</label>
            <input type="text" class="form-control" wire:model="phone">
            @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" class="form-control" wire:model="email">
            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label>Department</label>
            <select class="form-select" wire:model="department_id">
                <option selected="" disabled="" value="">Choose...</option>
            </select>
            @error('department_id') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label>Designation</label>
            <select class="form-select" wire:model="designation_id">
                <option selected="" disabled="" value="">Choose...</option>
            </select>
            @error('designation_id') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
 
        
        <button type="submit" class="btn btn-success">{{ $employee_id ? 'Update' : 'Create' }}</button>
        <a href="{{ route('employee.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>