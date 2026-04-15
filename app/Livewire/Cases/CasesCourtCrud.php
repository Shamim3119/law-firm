<?php

namespace App\Livewire\Cases;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Court;
use App\Models\Cases;

class CasesCourtCrud extends Component
{
    public $case_id;
    public $court_id;
    public $court_no;
    public $name;
    public $chief_justice;
    public $updateMode = false;

    #[On('setCaseId')]
    public function setCaseId($id)
    {
        $this->case_id = $id;
        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        $this->court_id = null;
        $this->court_no = '';
        $this->name = '';
        $this->chief_justice = '';
    }

    public function store()
    {
        $validatedData = $this->validate([
            'court_no' => 'required|string',
            'name' => 'required|string',
            'chief_justice' => 'required|string'
        ]);

        if ($this->court_id) {
            $court = Court::find($this->court_id);

            if ($court) {
                $court->update($validatedData);
                $this->dispatch('show-toast', message: 'Updated Successfully.');
            }

        } else {

            $cases = Cases::findOrFail($this->case_id);
            $cases->update([
                'court_counter' => $cases->court_counter + 1,
            ]);

            $validatedData['case_id'] = $this->case_id;
            Court::create($validatedData);

            $this->dispatch('show-toast', message: 'Created Successfully.');
        }

        $this->resetInputFields();
        $this->updateMode = false;
    }

    public function edit($id)
    {
        $court = Court::findOrFail($id);

        $this->court_id = $court->id;
        $this->court_no = $court->court_no;
        $this->name = $court->name;
        $this->chief_justice = $court->chief_justice;

        $this->updateMode = true;
    }

    public function delete($id)
    {
        Court::find($id)?->delete();

        $cases = Cases::findOrFail($this->case_id);

        $cases->update([
            'court_counter' => $cases->court_counter - 1,
        ]);

        $this->dispatch('show-toast', message: 'Court Information Deleted Successfully.');
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function render()
    {
        $courts = [];

        if ($this->case_id) {
            $courts = Court::where('case_id', $this->case_id)
                ->orderBy('id', 'desc')
                ->get();
        }

        return view('livewire.cases.cases-court-crud', [
            'courts' => $courts
        ]);
    }
}