<?php

namespace App\Livewire\Ledger;

use Livewire\Component;

class LedgerCrud extends Component
{

    public $updateMode = false;
    public $activeTab = 'ledger';

    public function render()
    {
        return view('livewire.ledger.ledger-crud');
    }
}
