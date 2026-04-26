<div>
     @if($flag == true)
        @include('livewire.tab.attendance')
    @endif


    <div class="card card-primary card-outline mb-4">
        <div class="card-header">
            <div class="card-title">AttendanceList</div>
        </div>
        <div class="card-body">
 
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>
                            SL
                        </th>
                        <th>
                            ID
                        </th>
                        <th>
                            Name
                        </th>
                        <!--
                        <th>
                            Departmentr
                        </th>
                        <th>
                            Designation
                        </th>
-->
                        <th>
                            Day
                        </th>
                        <th>
                            Date
                        </th>
                        <th style='width: 200px;'>
                            In Time
                        </th>
                        <th style='width: 200px;'>
                            Out Time
                        </th>
                        <th>
                            Duration
                        </th>
                        <th>
                            Status
                        </th>
                        <th>
                            Description
                        </th>
                       
                    </tr>
                </thead>
                <tbody>
                    @forelse($attendances as $attendance)
                    <tr wire:key="attendance-{{ $loop->iteration }}">
            
                            <td>{{ $loop->iteration  }}</td>
                            <td>{{ $attendance->code }}</td>
                            <td>{{ $attendance->name }}</td>
                            <!--
                            <td>{{ $attendance->department }}</td>
                            <td>{{ $attendance->designation }}</td>
-->
                            <td>{{ $attendance->day }}</td>
                            <td>{{ $attendance->att_date }}</td>

                            <td> 
                                <form wire:submit.prevent="updateAttendance('{{ $attendance->date }}', 0, {{ $attendance->employee_id }})"> 
                                    <div class="row">
                                        <div class="col-9">
                                            <input type="time"
                                                class="form-control"
                                                wire:model="in_times.{{ $attendance->employee_id }}_{{ $attendance->date }}">
                                        </div>
                                        <div class="col-3"> 
                                            <button type="submit" class="btn btn-sm btn-success"><span class="bi bi-check"></span></button>
                                        </div>
                                    </div>  
                                </form>
                            </td>

                            <td>
                                <form wire:submit.prevent="updateAttendance('{{ $attendance->date }}', 1, {{ $attendance->employee_id }})"> 
                                    <div class="row">
                                        <div class="col-9">
                                            <input type="time"
                                                class="form-control"
                                                wire:model="out_times.{{ $attendance->employee_id }}_{{ $attendance->date }}">
                                        </div>
                                        <div class="col-3"> 
                                            <button type="submit" class="btn btn-sm btn-success"><span class="bi bi-check"></span></button>
                                        </div>
                                    </div>  
                                </form>
                            </td>

                            <td>{{ $attendance->duration }}</td>
                            <td>{{ $attendance->status }}</td>
                            <td>{{ $attendance->descp }}</td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">No clients found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {!! MyHelper::get_toast_dispatch() !!}
</div>
