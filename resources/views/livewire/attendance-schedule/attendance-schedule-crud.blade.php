<div>

    @if($isModal == true)
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active">Attendance Schedule</a>
            </li>
        </ul>
        <br>

        @include('livewire.attendance-schedule.attendance-schedule-form')
    @endif

    <div @if($updateMode) style="display:none;" @endif id='boxView' class="card card-primary card-outline mb-4">
        <div class="card-header">
            <div class="card-title">{{ ucfirst($activeTab) }} List</div>
        </div>
        <div class="card-body">

            <table class="table table-bordered mt-3">

                <thead>
                    <tr>
                        <th style="width:2%">SL</th>
                        <th>Name</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Interval Start</th>
                        <th>Interval End</th>
                        <th>Late Count</th>
                        <th style="text-align:center; width:10%;">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($schedules as $schedule)
                        <tr wire:key="schedule-row-{{ $schedule->id }}">

                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $schedule->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($schedule->start_time)->format('g:i A') }}</td>
                            <td>{{ \Carbon\Carbon::parse($schedule->end_time)->format('g:i A') }}</td>
                            <td>{{ \Carbon\Carbon::parse($schedule->interval_start)->format('g:i A') }}</td>
                            <td>{{ \Carbon\Carbon::parse($schedule->interval_end)->format('g:i A') }}</td>
                            <td>{{ $schedule->late_count }} Minuts.</td>


                            <td style="text-align:center">
                                @if($isModal == true)
                                    <button   
                                        wire:click="edit({{ $schedule->id }})"
                                        class="btn btn-primary btn-sm">
                                        Edit
                                    </button>

                                    <button
                                        wire:click="delete({{ $schedule->id }})"
                                        class="btn btn-danger btn-sm"
                                    >
                                        Delete
                                    </button>
                                @else
                                    <button 
                                        wire:click="selectSchedule({{ $schedule->id }})" 
                                        class="btn btn-warning btn-sm">
                                        Add
                                    </button>
                                @endif
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
 
    {!! MyHelper::get_toast_dispatch() !!}
    
</div>