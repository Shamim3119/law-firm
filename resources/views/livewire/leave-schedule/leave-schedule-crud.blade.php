<div>
 

    @if($isModal == true)

        @include('livewire.tab.leave-plane')
 
        @include('livewire.leave-schedule.leave-schedule-form')
    @endif

    <div @if($updateMode) style="display:none;" @endif id='boxView' class="card card-primary card-outline mb-4">

        <div class="card-header">
            <div class="card-title">Leave Schedule List</div>
        </div>
        <div class="card-body">

            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th style="width:2%">SL</th>
                        <th>Name</th>
                        <th>Description</th>
                        @foreach($leave_types as $leave_type)
                            <th style='text-align:center;'>{{ $leave_type->name }}</th>
                        @endforeach
                        <th style="text-align:center; width:10%;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($schedules as $schedule)
                        <tr wire:key="schedule-row-{{ $schedule->id }}">

                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $schedule->name }}</td>
                            <td>{{ $schedule->description }}</td>

                            @foreach($leave_types as $leave_type)
                            <td style='text-align:center;'>
                                {{
                                    optional(
                                        $schedule->details
                                            ->where('leave_type_id', $leave_type->id)
                                            ->first()
                                    )->days ?? 0
                                }}
                            </td>
                            @endforeach
 
                            <td style="text-align:center">
                                @if($isModal == true)
                                    <button wire:click="edit({{ $schedule->id }})" class="btn btn-primary btn-sm">Edit</button>
                                    <button wire:click="delete({{ $schedule->id }})" class="btn btn-danger btn-sm">Delete</button>
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