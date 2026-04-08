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
   
 

<a href="{{ route('cases.create') }}" class="btn btn-primary mb-3">Add Cases</a>
<br>
@if (session()->has('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    <br>
@endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Titel</th>
                <th>Descriptions</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cases as $case)
            <tr>
                <td>{{ $case->titel }}</td>
                <td>{{ $case->descriptions }}</td>
                <td>
                    <a href="{{ route('cases.edit', $case->id) }}" class="btn btn-sm btn-warning">Edit</a>
               
                    <button 
                        wire:click="delete({{ $case->id }})" 
                        onclick="confirm('Are you sure you want to delete this case?') || event.stopImmediatePropagation()"
                        class="btn btn-danger btn-sm">
                        Delete
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


 