<div class='m-3'>


    <!-- Form -->
    <form wire:submit.prevent="store">

        <div class="mb-3">
            <label>Court</label>
           <select id="id_court" class="form-select" wire:model="court_id">
                @foreach($courts as $court)
                    <option selected value="{{ $court->id }}">{{ $court->court_no }} / {{ $court->name }}</option>
                @endforeach
            </select>
            @error('court_id') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <div class="row">
                <div class="col-6">
                    <label>Hearing Date</label>
 
                    <div
                        x-data="{
                            picker: null,

                            init() {
                                this.picker = flatpickr(this.$refs.input, {
                                    dateFormat: 'Y-m-d',

                                    onChange: (selectedDates, dateStr) => {
                                        this.$wire.set('hearing_date', dateStr);
                                    }
                                });

                                // IMPORTANT: listen to edit event
                                Livewire.on('fill-hearing-form', (data) => {
                                    const d = data[0];

                                    // sync Livewire state first
                                    this.$wire.set('court_id', d.court_id);
                                    this.$wire.set('hearing_date', d.hearing_date);
                                    this.$wire.set('hearing_time', d.hearing_time);
                                    this.$wire.set('hearing_id', d.id);

                                    // THEN update UI
                                    this.picker.setDate(d.hearing_date, true);

                                    document.getElementById('id_court').value = d.court_id;
                                    document.getElementById('time_hearing').value = d.hearing_time;

                            
                                });
                            }
                        }"
                        x-init="init()"
                    >
                        <input type="text" x-ref="input" class="form-control">
                    </div>
                    @error('hearing_date') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="col-6">
                    <label>Hearing Time</label>
  
                    <input id='time_hearing' type="time" class="form-control" wire:model="hearing_time">
                                @error('hearing_time') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
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
    <h5 class="mt-3 text-capitalize">Hearing Details</h5>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>SL</th>
                <th>Court No</th>
                <th>Hearing Date</th>
                <th>Hearing Time</th>
                <th style="text-align: center; width: 150px;">Action</th>
            </tr>
        </thead>
        <tbody>
            
            @foreach($hearings as $hearing)
                <tr wire:key="param-{{ $hearing->id }}">
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $hearing->court->name ?? '' }}</td>
                    <td>{{ \Carbon\Carbon::parse($hearing->hearing_date)->format('d M, Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($hearing->hearing_time)->format('g:i A') }}</td>
                    <td style="text-align: center">
                        <button wire:click="edit({{ $hearing->id }})" class="btn btn-primary btn-sm">Edit</button>
                        <button wire:click="delete({{ $hearing->id }})" class="btn btn-danger btn-sm">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

 
 

{!! MyHelper::get_toast_dispatch() !!}
 
</div>
