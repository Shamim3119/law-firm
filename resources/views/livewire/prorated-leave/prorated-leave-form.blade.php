    <div>
        
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
                            <label>Leave Schedule :</label>
                            <select class="form-select" wire:model="schedule_id">
                                      <option selected value="">Select Schedule</option>
                                    @foreach($schedules as $schedule)
                                        <option selected value="{{ $schedule->id}}">{{ $schedule->name }}</option>
                                    @endforeach
                            </select>
                            @error('schedule_id') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                    
                        <div class="mb-3">
                            <label>Leave Type :</label>
                            <option selected value="">Select Leave Type</option>
                            <select class="form-select" wire:model="leave_type_id">
                                    <option selected value="">Select Leave Type</option>
                                    @foreach($leave_types as $leave_type)
                                        <option selected value="{{ $leave_type->id}}">{{ $leave_type->name }}</option>
                                    @endforeach
                            </select>
                            @error('leave_type_id') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>


                        <div class="row">
                            <div class="col-6 mb-3">
                                <label>January :</label>
                                <input type="text" class="form-control" wire:model="january">
                                @error('january') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="col-6 mb-3">
                                <label>February :</label>
                                <input type="text" class="form-control" wire:model="february">
                                @error('february') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                         </div>




                        <div class="row">
                            <div class="col-6 mb-3">
                                <label>March :</label>
                                <input type="text" class="form-control" wire:model="march">
                                @error('march') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-6 mb-3">
                                <label>April :</label>
                                <input type="text" class="form-control" wire:model="april">
                                @error('april') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                         </div>


                         <div class="row">
                            <div class="col-6 mb-3">
                                <label>May :</label>
                                <input type="text" class="form-control" wire:model="may">
                                @error('may') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-6 mb-3">
                                <label>June :</label>
                                <input type="text" class="form-control" wire:model="june">
                                @error('june') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                         </div>



                         <div class="row">
                            <div class="col-6 mb-3">
                                <label>July :</label>
                                <input type="text" class="form-control" wire:model="july">
                                @error('july') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-6 mb-3">
                                <label>August :</label>
                                <input type="text" class="form-control" wire:model="august">
                                @error('august') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                         </div>



                        <div class="row">
                            <div class="col-6 mb-3">
                                <label>September :</label>
                                <input type="text" class="form-control" wire:model="september">
                                @error('september') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-6 mb-3">
                                <label>October :</label>
                                <input type="text" class="form-control" wire:model="october">
                                @error('october') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                         </div>



                         <div class="row">
                            <div class="col-6 mb-3">
                                <label>November :</label>
                                <input type="text" class="form-control" wire:model="november">
                                @error('november') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-6 mb-3">
                                <label>December :</label>
                                <input type="text" class="form-control" wire:model="december">
                                @error('december') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                         </div>
 
  

 
                    <div class="card-footer">
                        <div class="m-3 d-flex justify-content-center">
                            @if($prorated_id)
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
</div>
