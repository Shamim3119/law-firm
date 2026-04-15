<?php

namespace App\Livewire\Cases;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Cases;

class CasesList extends Component
{
    public $cases;
    public $activeTab = 'clients';

    #[On('refreshCases')]
    public function refreshCases()
    {
        $this->cases = Cases::all();
    }


    public $modalType;
    public $selectedCaseId;
    public $modalTitle;

    public function openModal($type, $caseId)
    {
        $this->modalType = $type;
        $this->selectedCaseId = $caseId;

        if ($type == 'payment') {
            $this->modalTitle = 'Payment Details';
        } elseif ($type == 'court') {
            $this->modalTitle = 'Court Details';
        } else {
            $this->modalTitle = 'Hearing Details';
        }

        $this->dispatch('setCaseId', id: $caseId);
    }

    public function mount()
    {
        $this->cases = Cases::all();

        if (request()->has('tab')) {
            $this->activeTab = request('tab');
        }
    }

    public function switchTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function delete($id)
    {
        Cases::findOrFail($id)->delete();

        // refresh after delete
        $this->cases = Cases::all();

        session()->flash('message', 'Cases Deleted Successfully.');
    }

    public function render()
    {
        return view('livewire.cases.cases-list')->layout('layouts.app', [
            'title' => 'Cases',
            'sub_title' => 'Cases List'
        ]);
    }
}