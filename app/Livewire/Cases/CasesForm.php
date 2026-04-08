<?php

namespace App\Livewire\Cases;

use Livewire\Component;
use App\Models\Cases;

class CasesForm extends Component
{
    public $case_id;
    public $title, $descriptions;


    public function mount($id = null)
    {
        if ($id) {
            $case = Cases::findOrFail($id);
            $this->case_id = $case->id;
            $this->title = $case->title;
            $this->descriptions = $case->descriptions;
        }
    }

    public function save()
    {
        $this->validate([
            'title' => 'required',
            'descriptions' => 'required',
        ]);

        Cases::updateOrCreate(
            ['id' => $this->case_id],
            [
                'title' => $this->title,
                'descriptions' => $this->descriptions,
            ]
        );

        session()->flash('message', $this->case_id ? 'Case Updated Successfully' : 'Case Created Successfully');

        return redirect()->route('cases.index');
    }

    public function render()
    {
        return view('livewire.cases.cases-form')->layout('layouts.app', [
            'title' => $this->case_id ? 'Edit Case' : 'Add Case',
            'sub_title' => 'Case Form'
        ]);
    }
 
}
