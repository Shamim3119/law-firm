<div>
    <!-- Tabs -->
    <ul class="nav nav-tabs">


        <li class="nav-item">
            <a href="{{ route('parameter.index', ['tab' => 'leave-type']) }}"
            class="nav-link {{ $activeTab == 'leave-type' ? 'active' : '' }}">
                Leave Type
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('parameter.index', ['tab' => 'department']) }}"
            class="nav-link {{ $activeTab == 'department' ? 'active' : '' }}">
                Department
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('parameter.index', ['tab' => 'designation']) }}"
            class="nav-link {{ $activeTab == 'designation' ? 'active' : '' }}">
                Designation
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('parameter.index', ['tab' => 'appointment-type']) }}"
            class="nav-link {{ $activeTab == 'appointment-type' ? 'active' : '' }}">
                Appointment Type
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('parameter.index', ['tab' => 'religion']) }}"
            class="nav-link {{ $activeTab == 'religion' ? 'active' : '' }}">
                Religion
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('parameter.index', ['tab' => 'gender']) }}"
            class="nav-link {{ $activeTab == 'gender' ? 'active' : '' }}">
                Gender
            </a>
        </li>

                <li class="nav-item">
            <a href="{{ route('parameter.index', ['tab' => 'bank-type']) }}"
            class="nav-link {{ $activeTab == 'bank-type' ? 'active' : '' }}">
                Bank Type
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ route('bank-operator.index', ['tab' => 'bank-operator']) }}"
            class="nav-link {{ $activeTab == 'bank-operator' ? 'active' : '' }}">
                Bank Operator
            </a>
        </li>

    </ul>
    <br>

    <div class='row'>
        <div class='col-12 col-md-6'>


            <button 
                wire:click="create"
                class="mb-3 btn btn-sm btn-primary"
                @if($updateMode) style="display:none;" @endif
            >
                New {{ ucfirst($activeTab) }}
            </button>
         
 
            <div @if(!$updateMode) style="display:none;" @endif id='boxNew' class="card card-primary card-outline mb-4">
                <div class="card-header">
                    <div class="card-title">{{ ucfirst($activeTab) }} Update</div>
                </div>

                <form wire:submit.prevent="store" wire:key="bank_operator-form-{{ $updateMode ? 'edit' : 'create' }}">
                    
                    <div class="card-body">

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1" wire:model="inactive">
                            <label class="form-check-label" for="exampleCheck1">Inactive</label>
                        </div>
 


                        <div class="mb-3">
                          <label>Bank Type :</label>
                                <select class="form-select" wire:model="type_id">
                                    <option selected value="">Select Bank Type</option>
                                        @foreach($bank_types as $type)
                                            <option value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endforeach
                                </select>
                                @error('type_id') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="mb-2">{{ ucfirst($activeTab) }} :</label>
                            <input
                                type="text"
                                class="form-control"
                                placeholder="Name"
                                wire:model.defer="name"
                            >
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="m-3 d-flex justify-content-center">
                            @if($bank_operator_id)
                                <button type="submit" class="btn btn-primary">Update</button>&nbsp;&nbsp;
                                <button type="button" wire:click="cancel" class="btn btn-secondary">Cancel</button>
                            @else
                                <button type="submit" class="btn btn-success">Save</button>&nbsp;&nbsp;
                                <button type="button" wire:click="cancel" class="btn btn-secondary">Cancel</button>
                            @endif
                        </div>
                    </div>
                </form>
            </div>
        
    

            <div @if($updateMode) style="display:none;" @endif id='boxView' class="card card-primary card-outline mb-4">
                <div class="card-header">
                    <div class="card-title">{{ ucfirst($activeTab) }} List</div>
                </div>
                <div class="card-body">

                    <table class="table table-bordered mt-3">

                        <thead>
                            <tr>
                                <th style="width:2%">SL</th>
                                <th>Type</th>
                                <th>Name</th>
                                <th style="width:15%;text-align:center;">Status</th>
                                <th style="text-align:center; width:150px;">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach($bank_operators as $bank_operator)
                                <tr wire:key="bank-operator-row-{{ $bank_operator->id }}">

                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $bank_operator->bank_type ? $bank_operator->bank_type->name : 'N/A' }}</td>
                                    <td>{{ $bank_operator->name }}</td>
                                    <td class="{{ $bank_operator->inactive ? 'text-danger' : '' }}" style="text-align:center">{{ $bank_operator->inactive == 0 ? 'Active' : 'Inactive' }}</td>

                                    <td style="text-align:center;width:150px;">
                                        <button   
                                            wire:click="edit({{ $bank_operator->id }})"
                                            class="btn btn-primary btn-sm">
                                            Edit
                                        </button>

                                        <button
                                            wire:click="delete({{ $bank_operator->id }})"
                                            class="btn btn-danger btn-sm"
                                        >
                                            Delete
                                        </button>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {!! MyHelper::get_toast_dispatch() !!}

</div>
