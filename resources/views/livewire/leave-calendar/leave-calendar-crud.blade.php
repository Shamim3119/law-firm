<div>
    @include('livewire.tab.leave-plane')

    <div class='row' @if($updateMode) style="display:none;" @endif >
        <div class='col-3'>
            <div class="mb-3">
                <label>Leave Calendar :</label>
                <select class="form-select" wire:model="calendar_id">
                        @foreach($calendars as $calendar)
                            <option selected value="{{ $calendar->id}}">{{ $calendar->year }} - {{ $calendar->title }}</option>
                        @endforeach
                </select>
            </div>
        </div>
        <div class='col-9'><br>
            <button wire:click="load" class="mb-3 btn btn-sm btn-warning">
                Load
            </button>
            &nbsp; &nbsp; &nbsp;
            <button wire:click="create" class="mb-3 btn btn-sm btn-primary">
                New {{ ucfirst($activeTab) }}
            </button>
            &nbsp;
            <button wire:click="updateAll" class="mb-3 btn btn-sm btn-success">
                Update
            </button>
             &nbsp;

             <button class="mb-3 btn btn-sm btn-info"
                    data-bs-toggle="modal"
                    data-bs-target="#ModalWeekend">
                Apply weekend
            </button>
<!--
            <button class="mb-3 btn btn-sm btn-info"
                    wire:click="openWeekendModal"
                    data-bs-toggle="modal"
                    data-bs-target="#ModalWeekend">
                Apply weekend
            </button>
-->
             &nbsp;
            <a  href="{{ route('pdf') }}" target="_blank" class="mb-3 btn btn-sm btn-danger" >
                Print Calendar
            </a>
        </div>
    </div>


 
    @include('livewire.leave-calendar.leave-calendar-form')


    <div @if($updateMode) style="display:none;" @endif id='boxView' class="card card-primary card-outline mb-4">

        <div class="card-header">
            <div class="card-title">{{ ucfirst($activeTab) }}</div>
        </div>
        <div class="card-body">

        <div class="card-body">
                @if(!empty($calendarDetails) && count($calendarDetails) > 0)
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style='width:2%;'>SL</th>
                                <th>Year</th>
                                <th>Date</th>
                                <th>Day</th>
                                <th>Holiday</th>
                                <th>Flexible Day</th>
                                <th>Descriptions</th>
     
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($calendarDetails as $detail)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $detail->year }}</td>
                                    <td>{{ $detail->date }}</td>
                                    <td>{{ $detail->day }}</td>
                                    <td><input type="checkbox" wire:model="holiday.{{ $detail->id }}"></td>
                                    <td><input type="checkbox" wire:model="flexible_day.{{ $detail->id }}"></td>
                                    <td><input type="text" class="form-control" wire:model.defer="description.{{ $detail->id }}"></td>
                       
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>No data loaded.</p>
                @endif
            </div>

 
        </div>
    </div>
 
    {!! MyHelper::get_toast_dispatch() !!}

 
</div>