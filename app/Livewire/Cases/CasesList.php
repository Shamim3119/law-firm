<?php

namespace App\Livewire\Cases;

use Livewire\Component;

class CasesList extends Component
{
    public $cases;
    public $activeTab = 'clients';

    public function mount()
    {
        if (request()->has('tab')) {
            $this->activeTab = request('tab');
        }
    }

    public function switchTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function render()
    {
        $this->cases = \App\Models\Cases::all();

        return view('livewire.cases.cases-list')->layout('layouts.app', [
            'title' => 'Cases',
            'sub_title' => 'Cases List'
        ]);
    }

    public function delete($id)
    {
        \App\Models\Cases::findOrFail($id)->delete();

        session()->flash('message', 'Cases Deleted Successfully.');
    }
    
 
}



   


