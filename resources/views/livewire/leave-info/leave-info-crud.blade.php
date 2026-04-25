<div>
    @if($flag == true)
        @include('livewire.tab.leave')
        @include('livewire.leave-info.leave-info-form')
    @endif

    
    <div @if($updateMode) style="display:none;" @endif id='boxView' class="card card-primary card-outline mb-4">
        <div class="card-header">
            <div class="card-title">{{ ucfirst($activeTab) }} List</div>
        </div>
        <div class="card-body">


        <div class="row mb-3">

            <div class="col-md-3">
                <input type="text" class="form-control" placeholder="Search Employee..."
                    wire:model.live="search">
            </div>
            
            <div class="col-md-1 pt-2 d-flex justify-content-end">
                <label>Leave From :</label>
            </div>

            <div class="col-md-1">
                <div wire:ignore>
                    <input type="text" id="from_date_filter" class="form-control" wire:model="from_date_filter">
                </div>
                @error('from_date_filter') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="col-md-1 pt-2 d-flex justify-content-end">
                <label>Leave To :</label>
            </div>


            <div class="col-md-1">
                <div wire:ignore>
                    <input type="text" id="to_date_filter" class="form-control" wire:model="to_date_filter">
                </div>
                @error('to_date_filter') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="col-md-1 pt-1">
                <button wire:click="resetFilters" class="btn btn-sm btn-warning w-100">
                    Reset
                </button>
            </div>

            <div class="col-md-3"><br>
            </div>

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
 
                <!-- Table -->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th wire:click="sortBy('employees.code')" style="cursor:pointer;">
                                                ID @include('sort-icon', ['field' => 'employees.code'])
                            </th>

                            <th wire:click="sortBy('employees.name')" style="cursor:pointer;">
                                Name @include('sort-icon', ['field' => 'employees.name'])
                            </th>

                            <th wire:click="sortBy('desig.name')" style="cursor:pointer;">
                                Designation @include('sort-icon', ['field' => 'desig.name'])
                            </th>

                            <th wire:click="sortBy('dept.name')" style="cursor:pointer;">
                                Department @include('sort-icon', ['field' => 'dept.name'])
                            </th>

                            <th wire:click="sortBy('lt.name')" style="cursor:pointer;">
                                Type @include('sort-icon', ['field' => 'lt.name'])
                            </th>

                            <th wire:click="sortBy('leaves.leave_from')" style="cursor:pointer;">
                                From @include('sort-icon', ['field' => 'leaves.leave_from'])
                            </th>

                            <th wire:click="sortBy('leaves.leave_to')" style="cursor:pointer;">
                                To @include('sort-icon', ['field' => 'leaves.leave_to'])
                            </th>
                            <th style='text-align:center;'>Duration</th>
                            <th style='text-align:center;'>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                       @forelse($leaves as $leave)
                        <tr wire:key="leave-{{ $leave->id }}">

                            <td>{{ ($leaves->currentPage() - 1) * $leaves->perPage() + $loop->iteration }}</td>
                            <td style='text-align:center;'>{{ $leave->employee_code ?? '-' }}</td>
                            <td>{{ $leave->employee_name ?? '-' }}</td>
                            <td>{{ $leave->designation_name ?? '-' }}</td>
                            <td>{{ $leave->department_name ?? '-' }}</td>
                            <td>{{ $leave->leave_type_name ?? '-' }}</td>

                   
                            <td style='text-align:center;'>{{ \Carbon\Carbon::parse($leave->leave_from)->format('d M, Y') }}</td>
                            <td style='text-align:center;'>{{ \Carbon\Carbon::parse($leave->leave_to)->format('d M, Y') }}</td>
                            <td style='text-align:center;'>{{ \Carbon\Carbon::parse($leave->leave_from)->diffInDays(\Carbon\Carbon::parse($leave->leave_to)) + 1 }}</td>
                   

                            <td style="text-align:center;">
                                <button wire:click="edit({{ $leave->id }})" class="btn btn-primary btn-sm">
                                    Edit
                                </button>

                                <button wire:click="delete({{ $leave->id }})"
                                    onclick="confirm('Are you sure?') || event.stopImmediatePropagation()"
                                    class="btn btn-danger btn-sm">
                                    Delete
                                </button>
                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="text-center">No data found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-3">
                    {{ $leaves->links() }}
                </div>
 

            {!! MyHelper::get_toast_dispatch() !!}

        </div>
    </div>

    <script> 
 
        flatpickr("#from_date_filter", {
            dateFormat: "Y-m-d",
            onChange: function(selectedDates, dateStr) {
                @this.set('from_date_filter', dateStr);
            }
        });

        flatpickr("#to_date_filter", {
            dateFormat: "Y-m-d",
            onChange: function(selectedDates, dateStr) {
                @this.set('to_date_filter', dateStr);
            }
        });

        document.addEventListener('livewire:init', () => {
            Livewire.on('open-edit-box', () => {
                fadeToggle('btnNew', 'boxNew', 'boxView');
            });
        });
    </script>
</div>