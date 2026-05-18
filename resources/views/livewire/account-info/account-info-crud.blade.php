<div class='m-3'>

<form wire:submit.prevent="store">



    <div class="mb-3 form-check">
        <input
            type="checkbox"
            class="form-check-input"
            wire:model="inactive"
            id="inactive"
        >

        <label class="form-check-label" for="inactive">
            Inactive
        </label>
    </div>

    <div class="mb-3">
        <label>Bank Type :</label>

        <select class="form-select" wire:model.live="type_id">

            <option value="">--Select--</option>

            @foreach($bank_types as $type)

                <option value="{{ $type->id }}">
                    {{ $type->name }}
                </option>

            @endforeach

        </select>

        @error('type_id')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-3">
        <label>Bank Name :</label>

        <select class="form-select" wire:model="bank_id">

            <option value="">--Select--</option>

            @foreach($banks as $bank)

                <option value="{{ $bank->id }}">
                    {{ $bank->name }}
                </option>

            @endforeach

        </select>

        @error('bank_id')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-3">
        <label>Account No</label>

        <input
            type="text"
            class="form-control"
            wire:model="account_no"
        >

        @error('account_no')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-3">
        <label>Account Name</label>

        <input
            type="text"
            class="form-control"
            wire:model="name"
        >

        @error('name')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-3">
        <label>Description</label>

        <input
            type="text"
            class="form-control"
            wire:model="description"
        >

        @error('description')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-3">

        @if($updateMode)

            <button type="submit" class="btn btn-primary btn-sm">
                Update
            </button>

            <button
                type="button"
                class="btn btn-secondary btn-sm"
                wire:click="cancel"
            >
                Cancel
            </button>

        @else

            <button type="submit" class="btn btn-success btn-sm">
                Save
            </button>

        @endif

    </div>

</form>

<br>

<h5 class="mt-3">Accounts Details</h5>

<table class="table table-bordered mt-3">

    <thead>
        <tr>
            <th>SL</th>
            <th>Account No</th>
            <th>Name</th>
            <th>Bank</th>
            <th>Type</th>
            <th style="text-align: right;">Balance</th>
            <th width="150">Action</th>
        </tr>
    </thead>

    <tbody>

        @foreach($accounts as $account)

            <tr>

                <td>{{ $loop->iteration }}</td>

                <td class="{{ $account->inactive ? 'text-danger' : '' }}">
                    {{ $account->account_no }}
                </td>

                <td class="{{ $account->inactive ? 'text-danger' : '' }}">
                    {{ $account->name }}
                </td>

                <td class="{{ $account->inactive ? 'text-danger' : '' }}">
                    {{ $account->bank->name ?? '' }}
                </td>

                <td class="{{ $account->inactive ? 'text-danger' : '' }}">
                    {{ $account->type->name ?? '' }}
                </td>
                <td style="text-align: right;" class="{{ $account->inactive ? 'text-danger' : '' }}">
                    {{ $account->balance ?? '' }}
                </td>

                <td>
                    <button
                        wire:click="edit({{ $account->id }})"
                        class="btn btn-primary btn-sm"
                    >
                        Edit
                    </button>

                    <button
                        wire:click="delete({{ $account->id }})"
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