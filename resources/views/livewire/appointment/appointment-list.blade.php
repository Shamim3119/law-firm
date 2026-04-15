<div> <!-- single root -->

 
@if($flag == 'true')
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link {{ $activeTab == 'clients' ? 'active' : '' }}" 
            href="{{ route('client.index', ['tab' => 'clients','flag' => 'true']) }}">
            Clients
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ $activeTab == 'appointments' ? 'active' : '' }}" 
            href="{{ route('appointment.index', ['tab' => 'appointments', 'flag' => 'true']) }}">
            Appointments
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ $activeTab == 'cases' ? 'active' : '' }}" 
            href="{{ route('cases.index', ['tab' => 'cases', 'flag' => 'true']) }}">
            Cases
            </a>
        </li>
    </ul>
<br>   
   
<a href="{{ route('appointment.create') }}" class="btn btn-primary mb-3">Add Appointment</a>
@endif
<br>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Code</th>
                <th>Titel</th>
                <th>Descriptions</th>
                <th>Lawyer</th>
                <th>Client</th>
            @if($flag == 'true')
                <th>Date</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th style='text-align:center;'>Status</th>
                <th style='text-align:center;'>Action</th>
            @else
                <th style='text-align:center;'>Add</th>
            @endif
            </tr>
        </thead>
        <tbody>
 
            @foreach($appointments as $appointment)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $appointment->code }}</td>
                <td>{{ $appointment->title }}</td>
                <td>{{ $appointment->descriptions }}</td>
                <td>{{ $appointment->employee->name ?? '' }}</td>
                <td>{{ $appointment->client->name ?? '' }}</td>
            @if($flag == 'true')
                <td>{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M, Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($appointment->appointment_start_time)->format('g:i A') }}</td>
                <td>{{ \Carbon\Carbon::parse($appointment->appointment_end_time)->format('g:i A') }}</td>
 
                <td align ='center'>
                    {!! \App\Helpers\MyHelper::get_status_button(
                        $appointment->status->id,
                        $appointment->id,
                        $appointment->status->name
                    ) !!}
                </td>
                <td align ='center'>
                    <a href="{{ route('appointment.edit', $appointment->id) }}" class="btn btn-sm btn-warning">Edit</a>
               
                    <button 
                        wire:click="delete({{ $appointment->id }})" 
                        onclick="confirm('Are you sure you want to delete this appointment?') || event.stopImmediatePropagation()"
                        class="btn btn-danger btn-sm">
                        Delete
                    </button>

                    <button 
                        type="button"
                        wire:click="$dispatch('setAppointmentId', { id: {{ $appointment->id }} })"
                        data-bs-toggle="modal" 
                        data-bs-target="#ModalLive" 
                        class="btn btn-sm btn-primary">
                        Reappoint
                    </button>
                </td>
            @else
                <td align ='center'>
                    <button 
 
                        wire:click="$dispatch('appointmentSelected', { data: { id: {{ $appointment->id }}, code: '{{ $appointment->code }}' } })"
                        class="btn btn-sm btn-warning">
                        Add
                    </button>
                    </td>
            @endif  
            </tr>
            @endforeach
        </tbody>
    </table>



    <div class="modal fade modal-lg" id="ModalLive" tabindex="-1" aria-labelledby="ModalLiveLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ModalLiveLabel">Appointment Details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @livewire('appointment.appointment-details-crud')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="ModalStatus" tabindex="-1" aria-labelledby="ModalLiveLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ModalLiveLabel">Status Details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @livewire('appointment.appointment-status')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


 
<script>
document.addEventListener('livewire:init', () => {
    Livewire.on('appointmentSelected', () => {

        let modalEl = document.getElementById('ModalLive');
        let modal = bootstrap.Modal.getInstance(modalEl);

        if (modal) {
            modal.hide();
        }

        setTimeout(() => {
            document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
            document.body.classList.remove('modal-open');
        }, 200);
    });
});
</script>


 
 
</div>


 