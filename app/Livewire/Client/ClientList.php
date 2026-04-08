<?php

namespace App\Livewire\Client;

use Livewire\Component;

class ClientList extends Component
{
    public $clients;
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
        $this->clients = \App\Models\Client::all();

        return view('livewire.client.client-list')->layout('layouts.app', [
            'title' => 'Client',
            'sub_title' => 'Client List'
        ]);
    }

    public function delete($id)
    {
        \App\Models\Client::findOrFail($id)->delete();

        session()->flash('message', 'Client Deleted Successfully.');
    }


}