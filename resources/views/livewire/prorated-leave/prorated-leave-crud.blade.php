<div>
    @include('livewire.tab.leave-plane')

    @include('livewire.prorated-leave.prorated-leave-form')

 
    <div @if($updateMode) style="display:none;" @endif id='boxView' class="card card-primary card-outline mb-4">
        <div class="card-header">
            <div class="card-title">{{ ucfirst($activeTab) }} List</div>
        </div>
        <div class="card-body">

            <table class="table table-bordered mt-3">

                <thead>
                    <tr>
                        <th style="width:2%">SL</th>
                        <th>Leave</th>
                        <th>Type</th>
                        <th>Jan</th>
                        <th>Feb</th>
                        <th>Mar</th>
                        <th>Apr</th>
                        <th>May</th>
                        <th>Jun</th>
                        <th>Jul</th>
                        <th>Aug</th>
                        <th>Sep</th>
                        <th>Oct</th>
                        <th>Nov</th>
                        <th>Dec</th>
                        <th style="text-align:center; width:150px;">Action</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($prorateds as $prorated)
                        <tr wire:key="prorated-row-{{ $prorated->id }}">

                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $prorated->schedule->name }}</td>
                            <td>{{ $prorated->leave_type->name }}</td>

                            <td>{{ $prorated->january }}</td>
                            <td>{{ $prorated->february }}</td>
                            <td>{{ $prorated->march }}</td>
                            <td>{{ $prorated->april }}</td>
                            <td>{{ $prorated->may }}</td>
                            <td>{{ $prorated->june }}</td>
                            <td>{{ $prorated->july }}</td>
                            <td>{{ $prorated->august }}</td>
                            <td>{{ $prorated->september }}</td>
                            <td>{{ $prorated->october }}</td>
                            <td>{{ $prorated->november }}</td>
                            <td>{{ $prorated->december }}</td>
                       
                            <td style="text-align:center">
                                <button   
                                    wire:click="edit({{ $prorated->id }})"
                                    class="btn btn-primary btn-sm">
                                    Edit
                                </button>

                                <button
                                    wire:click="delete({{ $prorated->id }})"
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
 
    {!! MyHelper::get_toast_dispatch() !!}

 <!--
    <script> 
        document.addEventListener('livewire:init', () => {
            Livewire.on('open-edit-box', () => {
                fadeToggle('btnNew', 'boxNew', 'boxView');
            });
        });
    </script>
-->
</div>
