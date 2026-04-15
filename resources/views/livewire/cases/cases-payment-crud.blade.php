<div>
    <form wire:submit.prevent="save" class="m-5">
        
        <div class="mb-3"> 
            <label>Appointment Status</label>
            <select class="form-select" wire:model="type_id">
                <option selected  value="">Choose...</option>
                <option value="0">Add Payment</option>
                <option value="1">Return Payment</option>
            </select>
          @error('type_id') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label>Payment Amount</label>
            <input type="text" class="form-control" wire:model="amount">
            @error('amount') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label>Remarks</label>
            <textarea class="form-control" wire:model="remarks"></textarea>
            @error('remarks') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="btn btn-success"> Update</button>
    </form>


    <!-- List -->
    <h4 class="mt-3 text-capitalize">Appointment Details</h4>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th style='text-align:center;width:2%;'>SL</th>
                <th style='text-align:center'>Type</th>
                <th style='text-align:center'>Data</th>
                <th style='text-align:right'>Amount</th>
                <th style='text-align:left'>Remarks</th>
            </tr>
        </thead>
        <tbody>
            
            @foreach($payments as $payment)
                <tr wire:key="param-{{ $payment->id }}">
                    <td>{{ $loop->iteration }}</td>
                    <td style='text-align:center'>{{ $payment->type }}</td>
                    <td style='text-align:center'>{{ $payment->created_at }}</td>
                    <td style='text-align:right'>{{ $payment->amount }}</td>
                    <td style='text-align:left'>{{ $payment->remarks }}</td>
                  
                </tr>
            @endforeach
        </tbody>
    </table>

</div>

 
