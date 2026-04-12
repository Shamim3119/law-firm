<div> <!-- single root -->



<ul class="nav nav-tabs">

  <li class="nav-item">
    <a 
      class="nav-link {{ $activeTab == 'clients' ? 'active' : '' }}" 
      href="{{ route('client.index', ['tab' => 'clients']) }}" 
       >
      Clients
    </a>
  </li>

  <li class="nav-item">
    <a 
      class="nav-link {{ $activeTab == 'appointments' ? 'active' : '' }}" 
      href="{{ route('appointment.index', ['tab' => 'appointments']) }}"
      >
      Appointments
    </a>
  </li>

    <li class="nav-item">
    <a 
      class="nav-link {{ $activeTab == 'cases' ? 'active' : '' }}" 
      href="{{ route('cases.index', ['tab' => 'cases']) }}"
 >
      Cases
    </a>
  </li>

</ul>
<br>   
   


<a href="{{ route('appointment.create') }}" class="btn btn-primary mb-3">Add Appointment</a>
<br>
 
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Titel</th>
                <th>Descriptions</th>
                <th>Lawyer</th>
                <th>Client</th>
                <th>Date</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($appointments as $appointment)
            <tr>
                <td>{{ $appointment->title }}</td>
                <td>{{ $appointment->descriptions }}</td>
                <td>{{ $appointment->employee->name ?? '' }}</td>
                <td>{{ $appointment->client->name ?? '' }}</td>
                <td>{{ $appointment->appointment_date }}</td>
                <td>{{ $appointment->appointment_start_time }}</td>
                <td>{{ $appointment->appointment_end_time }}</td>
                <!--
                <td>{{ $appointment->status->name }}</td>
-->
                <td>{!! MyHelper::get_status_button('{{ $appointment->status->id }}', '{{ $appointment->status->name }}') !!}</td>


                <td>
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


</div>


 