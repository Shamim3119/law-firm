    <div class='row'>
        <div class='col-12 col-md-6'>

            <button style='display:block;' onclick="fadeToggle('btnNew', 'boxNew', 'boxView')" id="btnNew" class="mb-3 btn btn-sm btn-primary" >
                New {{ ucfirst($activeTab) }}  
            </button>
         
            <div style='display:none;' id='boxNew' class="card card-primary card-outline mb-4">
                <div class="card-header">
                    <div class="card-title">{{ ucfirst($activeTab) }} Update</div>
                </div>

                <form wire:submit.prevent="store" wire:key="schedule-form-{{ $updateMode ? 'edit' : 'create' }}">
                    <div class="card-body">

                        <div class="mb-3">
                            <label class="mb-2">{{ ucfirst($activeTab) }} Name :</label>
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
                        <div class="row">
                            <div class="col-6 mb-2">
                                <label class="mb-2">Start Time</label>
                                <input type="time" class="form-control" wire:model="start_time">
                                @error('start_time') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-6 mb-2">
                                <label class="mb-2">End Time</label>
                                <input type="time" class="form-control" wire:model="end_time">
                                @error('end_time') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-2">
                                <label class="mb-2">Interval Time</label>
                                <input type="time" class="form-control" wire:model="interval_start">
                                @error('interval_start') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-6 mb-2">
                                <label class="mb-2">Interval End</label>
                                <input type="time" class="form-control" wire:model="interval_end">
                                @error('interval_end') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3 mb-2">
                                <label class="mb-2">Late Count</label>
                                <input type="text" class="form-control" wire:model="late_count">
                                @error('late_count') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-3 mb-2"><br>
                                <label class="pt-3">Minuts.</label>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="m-3 d-flex justify-content-center">
                            @if($updateMode)
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
