    <div class='row'>
        <div class='col-12 col-md-6'>

            <button 
                wire:click="create"
                class="mb-3 btn btn-sm btn-primary"
                @if($updateMode) style="display:none;" @endif
            >
                New {{ ucfirst($activeTab) }}
            </button>
         
            <div @if(!$updateMode) style="display:none;" @endif id='boxNew' class="card card-primary card-outline mb-4">

                <div class="card-header">
                    <div class="card-title">{{ ucfirst($activeTab) }} Update</div>
                </div>

                <form wire:submit.prevent="store" wire:key="schedule-form-{{ $updateMode ? 'edit' : 'create' }}">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="mb-2">{{ ucfirst($activeTab) }} Name :</label>
                            <input type="text" class="form-control" placeholder="Name" wire:model.defer="name">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label class="mb-2">Description :</label>
                            <input type="text" class="form-control" placeholder="Description" wire:model.defer="description">
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        @foreach($leave_types as $leave_type)
                            <div class="mb-3">
                                <label class="mb-2">{{ $leave_type->name }}</label>
                                <input type="text" class="form-control" placeholder="{{ $leave_type->name }}" wire:model.defer="leave_values.{{ $leave_type->id }}">
                                @error('leave_values.' . $leave_type->id)
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
           
                        @endforeach

                    </div>
                    <div class="card-footer">
                        <div class="m-3 d-flex justify-content-center">
                            @if($schedule_id)
                                <button type="submit" class="btn btn-primary">Update</button>&nbsp;&nbsp;
                                <button type="button" wire:click="cancel" class="btn btn-secondary">Cancel</button>
                            @else
                                <button type="submit" class="btn btn-success">Save</button>&nbsp;&nbsp;
                                <button type="button" wire:click="cancel" class="btn btn-secondary">Cancel</button>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
