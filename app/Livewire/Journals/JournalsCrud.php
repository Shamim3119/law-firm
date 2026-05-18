<?php

namespace App\Livewire\Journals;

use Livewire\Component;

class JournalsCrud extends Component
{

    public $updateMode = false;
    public $activeTab = 'journals';
    
    public function render()
    {
        return view('livewire.journals.journals-crud');
    }
}
