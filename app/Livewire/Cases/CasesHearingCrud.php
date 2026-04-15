<?php

namespace App\Livewire\Cases;

use Livewire\Component;
use App\Models\Cases;
use App\Models\Court;
use App\Models\Hearing;
use Livewire\Attributes\On;
 

class CasesHearingCrud extends Component
{
    public $courts = [];
    public $case_id;
    public $court_id;
    public $hearing_id;
    public $hearing_date;
    public $hearing_time;
    public $updateMode = false;
 
    #[On('setCaseId')]
    public function setCaseId($id)
    {
        $this->case_id = $id;
        $this->courts = Court::where('case_id', $id)->get();
        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        $this->court_id = '';
        $this->hearing_date = '';
        $this->hearing_time = '';
    }

    public function store()
    {
        $validatedData = $this->validate([
            'court_id' => 'required|integer',
            'hearing_date' => 'required|string',
            'hearing_time' => 'required|string'
 
        ]);

        if ($this->hearing_id) {
            $court = Hearing::find($this->hearing_id);

            if ($court) {
                $court->update($validatedData);
                $this->dispatch('show-toast', message: 'Updated Successfully.');
         
            }
        } else {


            $cases = Cases::findOrFail($this->case_id);

            $cases->update([
                'hearing_counter' => $cases->hearing_counter + 1,
            ]);

            $validatedData['case_id'] = $this->case_id;
            Hearing::create($validatedData);

            $this->dispatch('show-toast', message: 'Created Successfully.');
  
        }

        $this->resetInputFields();
        $this->updateMode = false;
    }

    public function edit($id)
    {
        $hearing = Hearing::findOrFail($id);

        $this->hearing_id = $hearing->id;
        $this->court_id = $hearing->court_id;
        $this->hearing_date = $hearing->hearing_date;
        $this->hearing_time = $hearing->hearing_time;

        $this->updateMode = true;
    }

 
 
    public function render()
    {
        $hearings = [];

        if ($this->case_id) {
            $hearings = Hearing::where('case_id', $this->case_id)
                ->orderBy('id', 'desc')  
                ->get();
        }

        return view('livewire.cases.cases-hearing-crud', ['hearings' => $hearings]);
    }

    public function delete($id)
    {
        Hearing::find($id)?->delete();
       // session()->flash('message', 'Court Information Deleted Successfully.');

        $cases = Cases::findOrFail($this->case_id);

        $cases->update([
            'hearing_counter' => $cases->hearing_counter - 1,
        ]);

        $this->dispatch('show-toast', message: session('message'));
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }
}
