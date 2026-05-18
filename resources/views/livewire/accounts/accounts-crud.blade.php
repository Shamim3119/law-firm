<div>
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a 
            class="nav-link {{ $activeTab == 'accounts' ? 'active' : '' }}" 
            href="{{ route('accounts.index', ['tab' => 'accounts', 'flag' => 'true']) }}" 
            >
            Accounts
            </a>
        </li>
        <li class="nav-item">
            <a 
            class="nav-link {{ $activeTab == 'journals' ? 'active' : '' }}" 
            href="{{ route('journals.index', ['tab' => 'journals', 'flag' => 'true']) }}"
            >
            Journals
            </a>
        </li>
        <li class="nav-item">
            <a 
            class="nav-link {{ $activeTab == 'ledger' ? 'active' : '' }}" 
            href="{{ route('ledger.index', ['tab' => 'ledger', 'flag' => 'true']) }}"
        >
            Ledger
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
                            <label class="mb-2">{{ ucfirst($activeTab) }} Code:</label>
                            <input
                                type="text"
                                class="form-control"
                                placeholder="Name"
                                wire:model.defer="code"
                            >
                            @error('code')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
 
                        <div class="mb-3">
                            <label class="mb-2">{{ ucfirst($activeTab) }} Name :</label>
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
                        <div class="mb-3">
                            <label class="mb-2">Description :</label>
                            <input
                                type="text"
                                class="form-control"
                                placeholder="Description"
                                wire:model.defer="description"
                            >
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="m-3 d-flex justify-content-center">
                            @if($account_id)
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
        </div>
    </div>


    <div @if($updateMode) style="display:none;" @endif id='boxView' class="card card-primary card-outline mb-4">
        <div class="card-header">
            <div class="card-title">{{ ucfirst($activeTab) }} List</div>
        </div>
        <div class="card-body">

            <div class="row mb-3">

                <div class="col-md-3">
                    <input
                        type="text"
                        class="form-control"
                        placeholder="Search..."
                        wire:model.live.debounce.300ms="search"
                    >
                </div>

                <div class="col-md-2">
                    <select class="form-control" wire:model.live="perPage">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>

            </div>

            <table class="table table-bordered mt-3">

                <thead>

                    <tr>

                        <th wire:click="sortBy('id')" style="cursor:pointer;">
                            SL
                        </th>

                        <th wire:click="sortBy('code')" style="cursor:pointer;">
                            Code
                        </th>

                        <th wire:click="sortBy('name')" style="cursor:pointer;">
                            Name
                        </th>

                        <th wire:click="sortBy('type')" style="cursor:pointer;">
                            Type
                        </th>
                        <th wire:click="sortBy('acc_type')" style="cursor:pointer;">
                            A/C Type
                        </th>

                        <th wire:click="sortBy('balance')" style="cursor:pointer;">
                            Balance
                        </th>

                        <th style="text-align:center;">
                            Status
                        </th>

                        <th style="text-align:center; width:150px;">
                            Action
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($accounts as $account)

                        <tr wire:key="account-row-{{ $account->source_table }}-{{ $account->id }}">

                            <td>
                                {{ $accounts->firstItem() + $loop->index }}
                            </td>

                            <td>{{ $account->code }}</td>

                            <td>{{ $account->name }}</td>

                            <td>{{ $account->type }}</td>

                            <td>{{ $account->acc_type }}</td>

                            <td>{{ number_format($account->balance ?? 0, 2) }}</td>

                            <td
                                class="{{ $account->inactive ? 'text-danger' : 'text-success' }}"
                                style="text-align:center"
                            >
                                {{ $account->inactive ? 'Inactive' : 'Active' }}
                            </td>

                            <td style="text-align:center;">

                                <button
                                    wire:click="edit({{ $account->id }}, '{{ $account->source_table }}')"
                                    class="btn btn-primary btn-sm"
                                >
                                    Edit
                                </button>

                                <button
                                    wire:click="delete({{ $account->id }}, '{{ $account->source_table }}')"
                                    class="btn btn-danger btn-sm"
                                >
                                    Delete
                                </button>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="7" class="text-center">
                                No Data Found
                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

            <div class="mt-3">
                {{ $accounts->links() }}
            </div>
        </div>
    </div>
   

    {!! MyHelper::get_toast_dispatch() !!}

</div>
