<div> <!-- single root -->



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
   
 

<a href="{{ route('cases.create') }}" class="btn btn-primary mb-3">Add Cases</a>
<br>
 
    <table class="table table-bordered">
        <thead>
            <tr>
                <th style='width:2%'>SL</th>
                <th>Code</th>
                <th>Titel</th>
                <th>Descriptions</th>
                <th>Lawyer</th>
                <th>Client</th>
                <th style='text-align:right;'>Client</th>
                <th style='text-align:right;'>Payment</th>
                <th style='text-align:right;'>Due</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($cases as $case)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $case->code }}</td>
                <td>{{ $case->title }}</td>
                <td>{{ $case->descriptions }}</td>
                <td>{{ $case->employee->name ?? '' }}</td>
                <td>{{ $case->client->name ?? '' }}</td>

                <td style='text-align:right;'>{{ $case->charge }}</td>
                <td class="text-end">
                    <button 
                        type="button"
                        wire:click="$dispatch('setCaseId', { id: {{ $case->id }} })"
                        data-bs-toggle="modal" 
                        data-bs-target="#ModalPayment" 
                        class="btn btn-sm btn-primary">
                        {{ $case->payment }}
                    </button>  
                </td>
                <td style='text-align:right;'>{{ $case->due }}</td>
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

    <div class="modal fade" id="ModalPayment" tabindex="-1" aria-labelledby="ModalLiveLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ModalLiveLabel">Status Details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @livewire('cases.cases-payment-crud')
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</div>


 