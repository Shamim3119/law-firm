<?php

namespace App\Livewire\Cases;

use Livewire\Component;
use App\Models\Cases;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\DB;
use App\Models\Appointment;

class CasesForm extends Component
{
    public $case_id;
    public $title, $descriptions;
    public $code;
    public $charge;
    public $appointment_id;
 
 
    #[On('appointmentSelected')]
    public function appointmentSelected($data)
    {
        if (!$data) 
            return;

        $this->appointment_id = $data['id'];
        $this->code = $data['code'];
    }
 


    public function mount($id = null)
    {
        if ($id) {
            $case = Cases::findOrFail($id);
            $this->case_id = $case->id;
            $this->title = $case->title;
            $this->charge = $case->charge;
            
            $this->descriptions = $case->descriptions;
            $this->appointment_id = $case->appointment_id; 
            $this->code = $case->appointment->code;
        }
    }

    public function save()
    {
        $this->validate([

            'charge' => 'required',
            'title' => 'required',
            'descriptions' => 'required',
        ]);


        $client_id = DB::select("select client_id from appointments where id = ".$this->appointment_id)[0]->client_id;
        $employee_id = DB::select("select employee_id from appointments where id = ".$this->appointment_id)[0]->employee_id;

        Cases::updateOrCreate(
            ['id' => $this->case_id],
            [
                'appointment_id' => $this->appointment_id,
                'title' => $this->title,
                'descriptions' => $this->descriptions,
                'code' => str_replace('APP-', 'CAS-', $this->code),
                'charge' => $this->charge, 
                'client_id' => $client_id,
                'employee_id' => $employee_id,
            ]
        );

        $appointment = Appointment::findOrFail($this->appointment_id);
        $appointment->update([
            'status_id' => '5',
        ]);


        session()->flash('message', $this->case_id ? 'Case Updated Successfully' : 'Case Created Successfully');

        return redirect()->route('cases.index', ['tab' => 'cases', 'flag' => 'true']);
    }

    public function render()
    {
        return view('livewire.cases.cases-form')->layout('layouts.app', [
            'title' => $this->case_id ? 'Edit Case' : 'Add Case',
            'sub_title' => 'Case Form'
        ]);
    }
 
}
