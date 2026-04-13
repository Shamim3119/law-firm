<?php

namespace App\Livewire\Cases;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Payment;
use App\Models\Cases;
use Illuminate\Support\Facades\DB;

class CasesPaymentCrud extends Component
{

    public $case_id;
    public $type_id, $amount, $remarks;
 
    #[On('setCaseId')]
    public function setCaseId($id)
    {
        $this->case_id = $id;
        $this->resetInputFields();  
    }

    private function resetInputFields()
    {
        $this->type_id =  0;
        $this->amount = '';
        $this->remarks = '';
    }

    public function save()
    {
        $validatedData = $this->validate([
            'type_id' => 'required|integer',
            'amount' => ['nullable', 'numeric', 'regex:/^\d{1,8}(\.\d{1,2})?$/'],
        ]);

        $client_id = DB::select("select client_id from cases where id = ".$this->case_id)[0]->client_id;
        $employee_id = DB::select("select employee_id from cases where id = ".$this->case_id)[0]->employee_id;
        $appointment_id = DB::select("select appointment_id from cases where id = ".$this->case_id)[0]->appointment_id;
        $due = DB::select("select due from cases where id = ".$this->case_id)[0]->due;
        $payment = DB::select("select payment from cases where id = ".$this->case_id)[0]->payment;

        $newPayment = ($payment + $this->amount);
        $newDue = ($due - $this->amount);
        if($this->type_id == 1)
        {
            $newDue = ($due + $this->amount);
            $newPayment = ($payment - $this->amount);
        }

        Payment::create([
            'type_id' => $this->type_id,
            'amount' => $this->amount,
            'remarks' => $this->remarks,
            'case_id' => $this->case_id,
            'client_id' => $client_id,
            'employee_id' => $employee_id,
            'appointment_id' => $appointment_id,
            'active_amount' => $due,
            'next_amount' => $newDue,
        ]);
    $this->render();
        Cases::where('id', $this->case_id)->update([
            'payment' => $newPayment,
            'due' => $newDue,
        ]);


        $this->dispatch('refreshCases');
        $this->dispatch('show-toast', message: 'Payment Saved Successfully.');

        $this->resetInputFields();

 
    }


    public function render()
    {
        return view('livewire.cases.cases-payment-crud');
    }
}
