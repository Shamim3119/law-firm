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





<a href="{{ route('client.create') }}" class="btn btn-primary mb-3">Add Client</a>
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
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clients as $client)
            <tr>
                <td>{{ $client->name }}</td>
                <td>{{ $client->phone }}</td>
                <td>{{ $client->email }}</td>
                <td>
                    <a href="{{ route('client.edit', $client->id) }}" class="btn btn-sm btn-warning">Edit</a>
               
                    <button 
                        wire:click="delete({{ $client->id }})" 
                        onclick="confirm('Are you sure you want to delete this client?') || event.stopImmediatePropagation()"
                        class="btn btn-danger btn-sm">
                        Delete
                    </button>
               
<!--
                    <button wire:click="confirmDelete({{ $client->id }})" class="btn btn-danger btn-sm">
                        Delete
                    </button>
-->
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


 