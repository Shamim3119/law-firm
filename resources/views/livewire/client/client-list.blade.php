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

<div class="row mb-3">

    <!-- 🔍 Search -->
    <div class="col-md-4">
        <input 
            type="text"
            wire:model.live="search"
            class="form-control"
            placeholder="Search name, email, phone..."
        >
    </div>

    <!-- 📄 Per Page -->
    <div class="col-md-2">
        <select wire:model.live="perPage" class="form-control">
            <option value="10">10</option>
            <option value="20">20</option>
            <option value="30">30</option>
            <option value="40">40</option>
            <option value="50">50</option>
        </select>
    </div>

</div>

 

    <table class="table table-bordered">
      <thead>
          <tr>
              <th wire:click="sortBy('id')" style="cursor:pointer;">
                  ID
                  @if ($sortField === 'id')
                      @if ($sortDirection === 'asc') ↑ @else ↓ @endif
                  @endif
              </th>
              <th wire:click="sortBy('name')" style="cursor:pointer;">
                  Name
                  @if ($sortField === 'name')
                      @if ($sortDirection === 'asc') ↑ @else ↓ @endif
                  @endif
              </th>

              <th wire:click="sortBy('phone')" style="cursor:pointer;">
                  Phone
                  @if ($sortField === 'phone')
                      @if ($sortDirection === 'asc') ↑ @else ↓ @endif
                  @endif
              </th>

              <th wire:click="sortBy('email')" style="cursor:pointer;">
                  Email
                  @if ($sortField === 'email')
                      @if ($sortDirection === 'asc') ↑ @else ↓ @endif
                  @endif
              </th>

              <th>Action</th>
          </tr>
      </thead>
      <tbody>
          @forelse($clients as $client)
          <tr wire:key="client-{{ $client->id }}">
              <td>{{ $client->id }}</td>
              <td>{{ $client->name }}</td>
              <td>{{ $client->phone }}</td>
              <td>{{ $client->email }}</td>
              <td>
                  <a href="{{ route('client.edit', $client->id) }}" class="btn btn-sm btn-warning">Edit</a>

                  <button 
                      wire:click="delete({{ $client->id }})"
                      onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
                      class="btn btn-danger btn-sm">
                      Delete
                  </button>
              </td>
          </tr>
          @empty
          <tr>
              <td colspan="4" class="text-center">No clients found.</td>
          </tr>
          @endforelse
      </tbody>
    </table>


    <!-- Right: Pagination buttons -->
    <div>
        {{ $clients->links() }}
    </div>

 
</div>


 