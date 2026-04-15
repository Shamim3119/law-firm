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
        $this->type_id = 0;
        $this->amount = '';
        $this->remarks = '';
    }

    public function save()
    {
        $this->validate([
            'type_id' => 'required|integer',
            'amount' => ['nullable', 'numeric', 'regex:/^\d{1,8}(\.\d{1,2})?$/'],
        ]);

        // ✅ CLEAN QUERY (instead of multiple DB::select)
        $case = Cases::findOrFail($this->case_id);

        $client_id = $case->client_id;
        $employee_id = $case->employee_id;
        $appointment_id = $case->appointment_id;
        $due = $case->due;
        $payment = $case->payment;

        // calculation
        $newPayment = $payment + $this->amount;
        $newDue = $due - $this->amount;

        if ($this->type_id == 1) {
            $newDue = $due + $this->amount;
            $newPayment = $payment - $this->amount;
        }

        // save payment history
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

        // update case
        $case->update([
            'payment' => $newPayment,
            'due' => $newDue,
        ]);

        // 🔥 CLOSE MODAL
       // $this->dispatch('close-modal');

        // 🔥 REFRESH PARENT (VERY IMPORTANT)
       // $this->dispatch('refreshCases')->to(CasesList::class);

        // toast
        $this->dispatch('show-toast', message: 'Payment Saved Successfully.');

        $this->resetInputFields();
    }

    public function render()
    {
        $payments = [];

        if ($this->case_id) {
            $payments = Payment::where('case_id', $this->case_id)
               ->select('*', DB::raw("IF(type_id = 0, 'Add', 'Return') as type"))
                ->orderBy('id', 'desc')  
                ->get();
        }

        return view('livewire.cases.cases-payment-crud', ['payments' => $payments]);
    }
}