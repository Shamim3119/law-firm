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
                <th style='text-align:center;'>Court</th>
                <th style='text-align:center;'>Hearing</th>
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

                @php
                    $btn = 'success';
                    if ($case->payment == 0) {
                        $btn = 'danger';
                    } elseif ($case->payment < $case->charge) {
                        $btn = 'warning';
                    }
                @endphp

                <td class="text-end">
                    <button 
                        type="button"
                        wire:click="openModal('payment', {{ $case->id }})"
                        data-bs-toggle="modal" 
                        data-bs-target="#MainModal"
                        class="btn btn-sm btn-{{$btn}}">
                        {{ $case->payment }}
                    </button>  
                </td>
                <td style='text-align:right;'>{{ $case->due }}</td>

                @php
                    $btn_court = 'info';
                    if ($case->court_counter == 0) {
                        $btn_court = 'danger';
                    }  
                @endphp

                <td class="text-center">
                    <button 
                        type="button"
                        wire:click="openModal('court', {{ $case->id }})"
                        data-bs-toggle="modal" 
                        data-bs-target="#MainModal"
                        class="btn btn-sm btn-{{$btn_court}}">
                        Court
                    </button>  
                </td>
                @php
                    $btn_hearing  = 'primary';
                    if ($case->hearing_counter == 0) {
                        $btn_hearing = 'danger';
                    }  
                @endphp
                <td class="text-center">
                    <button 
                        type="button"
                        wire:click="openModal('hearing', {{ $case->id }})"
                        data-bs-toggle="modal" 
                        data-bs-target="#MainModal"
                        class="btn btn-sm btn-{{$btn_hearing}}">
                        Hearing
                    </button>  
                </td>
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

    <div class="modal fade modal-lg" id="MainModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                
                <div class="modal-header">
                    <h1 class="modal-title fs-5">{{ $modalTitle }}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    @if($modalType == 'payment')
                        @livewire('cases.cases-payment-crud', key('payment-'.$selectedCaseId))
                    @elseif($modalType == 'court')
                        @livewire('cases.cases-court-crud', key('court-'.$selectedCaseId))
                    @elseif($modalType == 'hearing')
                        @livewire('cases.cases-hearing-crud', key('hearing-'.$selectedCaseId))
                    @endif
                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>

            </div>
        </div>
    </div>

    <script>
        const modal = document.getElementById('MainModal');
            modal.addEventListener('hidden.bs.modal', function () {
                Livewire.dispatch('refreshCases');
            });
    </script>


{!! MyHelper::get_toast_dispatch() !!}

</div>


 