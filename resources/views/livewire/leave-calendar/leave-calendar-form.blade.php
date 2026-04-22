    <div class='row'>
        <div class='col-12 col-md-6'>
            <div @if(!$updateMode) style="display:none;" @endif id='boxNew' class="card card-primary card-outline mb-4">

                <div class="card-header">
                    <div class="card-title">{{ ucfirst($activeTab) }} Update</div>
                </div>

                <form wire:submit.prevent="store" wire:key="schedule-form-{{ $updateMode ? 'edit' : 'create' }}">
                    <div class="card-body">
 
                        
                        <div class="mb-3">
                            <label class="mb-2">Title :</label>
                            <input type="text" class="form-control" placeholder="Title" wire:model.defer="title">
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="m-3 d-flex justify-content-center">
                            <button type="submit" class="btn btn-success">Save</button>&nbsp;&nbsp;
                            <button type="button" wire:click="cancel" class="btn btn-secondary">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>



<div class="modal fade" id="ModalWeekend" tabindex="-1" aria-labelledby="ModalWeekendLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="ModalWeekendLabel">Apply Weekend</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body m-3">

                <div class="mb-3">
                    <label>Weekend day :</label>

                    <select class="form-select" wire:model="weekend_day">
                        <option value="Saturday">Saturday</option>
                        <option value="Sunday">Sunday</option>
                        <option value="Monday">Monday</option>
                        <option value="Tuesday">Tuesday</option>
                        <option value="Wednesday">Wednesday</option>
                        <option value="Thursday">Thursday</option>
                        <option value="Friday">Friday</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="mb-2">Description :</label>
                    <input type="text" class="form-control"
                        placeholder="Description"
                        wire:model="weekend_description">
                </div>


                <div class="mb-3">
                    <button type="button"
                            class="btn btn-sm btn-primary"
                            wire:click="applyWeekend"
                            data-bs-dismiss="modal">
                        Apply
                    </button>
              &nbsp;&nbsp;
                    <button type="button"
                        class="btn btn-sm btn-danger"
                        wire:click="cancelWeekend"
                        data-bs-dismiss="modal">
                        Cancel
                    </button>
            </div>
 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
