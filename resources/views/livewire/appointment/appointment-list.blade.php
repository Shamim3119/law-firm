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
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($appointments as $appointment)
            <tr>
                <td>{{ $appointment->title }}</td>
                <td>{{ $appointment->descriptions }}</td>
                <td>
                    <a href="{{ route('appointment.edit', $appointment->id) }}" class="btn btn-sm btn-warning">Edit</a>
               
                    <button 
                        wire:click="delete({{ $appointment->id }})" 
                        onclick="confirm('Are you sure you want to delete this appointment?') || event.stopImmediatePropagation()"
                        class="btn btn-danger btn-sm">
                        Delete
                    </button>
 
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


 