<div> <!-- single root -->

 
@if($flag == 'true')
    <ul class="nav nav-tabs">

        <li class="nav-item">
            <a 
            class="nav-link {{ $activeTab == 'clients' ? 'active' : '' }}" 
            href="{{ route('client.index', ['tab' => 'clients', 'flag' => 'true']) }}" 
            >
            Clients
            </a>
        </li>

        <li class="nav-item">
            <a 
            class="nav-link {{ $activeTab == 'appointments' ? 'active' : '' }}" 
            href="{{ route('appointment.index', ['tab' => 'appointments', 'flag' => 'true']) }}"
            >
            Appointments
            </a>
        </li>

        <li class="nav-item">
            <a 
            class="nav-link {{ $activeTab == 'cases' ? 'active' : '' }}" 
            href="{{ route('cases.index', ['tab' => 'cases', 'flag' => 'true']) }}"
        >
            Cases
            </a>
        </li>

    </ul>
    <br> 
    @include('livewire.client.client-form')
@endif



    <div style='opacity:1' id='boxView'  class="card card-primary card-outline mb-4">
        <div class="card-header">
            <div class="card-title">{{ ucfirst($activeTab) }} List</div>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <!-- 🔍 Search -->
                <div class="col-md-4">
                    <input 
                        type="text"
                        wire:model.live="search"
                        class="form-control"
                        placeholder="Search id, name, email, phone..."
                    >
                </div>

                <!-- 📄 Per Page -->
                <div class="col-md-1">
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
                        <th>
                            SL
                        </th>
                        <th wire:click="sortBy('code')" style="cursor:pointer;">
                            ID
                            @if ($sortField === 'code')
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

                        <th style='text-align:center;'>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($clients as $client)
                    <tr wire:key="client-{{ $client->id }}">
            
                            <td>{{ $loop->iteration  }}</td>
                            <td>{{ $client->code }}</td>
                            <td>{{ $client->name }}</td>
                            <td>{{ $client->phone }}</td>
                            <td>{{ $client->email }}</td>
                            <td align='center'>
                        @if($flag == 'true')
                                <button   
                                    wire:click="edit({{ $client->id }})"
                                    class="btn btn-primary btn-sm">
                                    Edit
                                </button>
                                <button 
                                    wire:click="delete({{ $client->id }})"
                                    onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
                                    class="btn btn-danger btn-sm">
                                    Delete
                                </button>
                            @else
                                <button 
                                    wire:click="$dispatch('clientSelected', { data: { id: {{ $client->id }}, name: '{{ $client->name }}' } })"
                                    class="btn btn-sm btn-warning">
                                    Add
                                </button>
                            @endif
                            </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center">No clients found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <br>
            <!-- Right: Pagination buttons -->
            <div>
                {{ $clients->links() }}
            </div>

            <script>
                window.addEventListener('clientSelected', () => {
                    let modalEl = document.getElementById('ModalLive');
                    let modal = bootstrap.Modal.getInstance(modalEl);

                    if (modal) {
                        modal.hide();
                    }

                    // 👇 IMPORTANT: cleanup leftover backdrop
                    setTimeout(() => {
                        document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
                        document.body.classList.remove('modal-open');
                        document.body.style.removeProperty('padding-right');
                    }, 300);
                });
            </script>
            {!! MyHelper::get_toast_dispatch() !!}
        </div>
    </div>
    <script> 
        document.addEventListener('livewire:init', () => {
            Livewire.on('open-edit-box', () => {
                fadeToggle('btnNew', 'boxNew', 'boxView');
            });
        });
    </script>
</div>


 