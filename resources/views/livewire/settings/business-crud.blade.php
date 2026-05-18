<div>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link {{ $activeTab == 'bussiness' ? 'active' : '' }}" 
            href="{{ route('bussiness.index', ['tab' => 'bussiness']) }}">
            Business
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $activeTab == 'profile' ? 'active' : '' }}" 
            href="{{ route('profile.index', ['tab' => 'profile']) }}">
            User Profile
            </a>
        </li>
    </ul>
    <br>
 
    <div class='row'>
        <div class='col-12 col-md-6'>
            <div @if(!$updateMode) style="display:none;" @endif id='boxNew' class="card card-primary card-outline mb-4">
    
                <form wire:submit.prevent="save">
 
                    <div class="card-header">
                        <div class="card-title">{{ ucfirst($activeTab) }} Update</div>
                    </div> 
                    <div class="card-body m-3">

                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text" class="form-control" wire:model="name">
                            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="mb-3">
                            <label>Address</label>
                            <input type="address" class="form-control" wire:model="address">
                            @error('emaaddressil') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label>Phone</label>
                            <input type="text" class="form-control" wire:model="phone">
                            @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label>Email</label>
                            <input   type="email" class="form-control" wire:model="email">
                            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-3">
                            <label>Web</label>
                            <input  type="web" class="form-control" wire:model="web">
                            @error('web') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>


                        <div class='row'>
                            <div class='col-8 mt-3'>
                                <div class="input-group mb-3">
                                    <input type="file" class="form-control" id="img" wire:model="logo">
                                    <label class="input-group-text" for="img">Upload</label>
                                </div>
                            </div>
                        
                            <div class='col-4 d-flex justify-content-center align-items-center'>
                                <img id="previewlogo"
                                    src="
                                        @if ($logo)
                                            {{ $logo->temporaryUrl() }}
                                        @elseif($business->logo)
                                            {{ asset('storage/' . $business->logo) }}
                                        @else
                                            https://via.placeholder.com/120
                                        @endif
                                    "
                                    class="rounded-circle border"
                                    width="120"
                                    height="120"
                                    style="object-fit: cover;">
                            </div>

                            <script>
                                document.getElementById('img').addEventListener('change', function(event) {
                                    const file = event.target.files[0];

                                    if (file) {
                                        const reader = new FileReader();

                                        reader.onload = function(e) {
                                            document.getElementById('previewImage').src = e.target.result;
                                        }

                                        reader.readAsDataURL(file);
                                    }
                                });
                            </script>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="m-3 d-flex justify-content-center">
            
                                <button type="submit" class="btn btn-success">Update</button>&nbsp;&nbsp;
                                <a href="{{ route('bussiness.index', ['tab' => 'bussiness']) }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
 
        <div class='col-12'>

            <div @if($updateMode) style="display:none;" @endif id='boxView' class="card card-primary card-outline mb-4">
                <div class="card-header">
                    <div class="card-title">{{ ucfirst($activeTab) }} List</div>
                </div>
                <div class="card-body">

                    <table class="table table-bordered mt-3">

                        <thead>
                            <tr>
                                <th style="width:2%">SL</th>
                                <th>Code</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Website</th>
                                <th style='text-align:center;'>Account</th>
                 
                                <th style="text-align:center; width:150px;">Action</th>
                            </tr>
                        </thead>
                            <tbody>
                                @if($business)
                                    <tr wire:key="busines-row-{{ $business->id }}">

                                        <td>1</td>
                                        <td>{{ $business->code }}</td>
                                        <td>{{ $business->name }}</td>
                                        <td>{{ $business->address }}</td>
                                        <td>{{ $business->email }}</td>
                                        <td>{{ $business->phone }}</td>
                                        <td>{{ $business->web }}</td>
                                        <td style='text-align:center;'>
                                            <button 
                                            wire:click="$dispatch('setRefId', { id: {{ $business->id }}, type: 3, code: '{{ $business->code }}' })"
                                            data-bs-toggle="modal"
                                            data-bs-target="#ModalAccount"
                                            class="btn btn-sm btn-{{ $business->account_count == 0 ? 'danger' : 'success' }}">{{ 'Account'}}
                                            </button>
                                        </td>

                                        <td style="text-align:center;width:150px;">
                                            <button
                                                wire:click="edit({{ $business->id }})"
                                                class="btn btn-primary btn-sm">
                                                Edit
                                            </button>
                                        </td>

                                    </tr>
                                @endif
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <script>

        document.addEventListener('livewire:init', () => {
            // Account modal
            Livewire.on('close-account-modal', () => {
                let modal = bootstrap.Modal.getInstance(document.getElementById('ModalAccount'));
                if (modal) modal.hide();
                cleanupModal();
            });

            function cleanupModal() {
                setTimeout(() => {
                    document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
                    document.body.classList.remove('modal-open');
                    document.body.style.removeProperty('padding-right');
                }, 300);
            }
        });

    </script>

    {!! MyHelper::get_toast_dispatch() !!}


    <div class="modal fade modal-lg" id="ModalAccount" tabindex="-1" aria-labelledby="ModalAccountLabel" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ModalAccountLabel">Apply Account Info</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body m-3">
    
                    @livewire('account-info.account-info-crud')
                </div>                   
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</div>