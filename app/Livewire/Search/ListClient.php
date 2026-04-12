<?php

namespace App\Livewire\Search;

use Livewire\Component;
use App\Models\Client;

class ListClient extends Component
{
    public $clients;

    public function render()
    {
        // Fetch clients
        $this->clients = Client::where('id', 5)->get(); // use proper property

        return view('livewire.search.list-client', [
            'clients' => $this->clients, // pass to view
        ]);
    }
}
