<?php

namespace App\Livewire\Search;

use Livewire\Component;


class Client extends Component
{
    public $clients;

    public function render()
    {
        $this->clients = Client::where('id', "5")->get();

        return view('livewire.search.client')->layout('layouts.app');
    }

 

}
