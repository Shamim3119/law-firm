<?php

namespace App\Livewire\Client;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Client;

class ClientList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $activeTab = 'clients';

    public $perPage = 10;
    public $search = '';
    public $page = 1;
    public $sortField = 'id';
    public $sortDirection = 'desc';
    public $flag = 'false';
 
    // Keep state in URL
    protected $queryString = [
        'search' => ['except' => ''],
        'perPage' => ['except' => 10],
        'page' => ['except' => 1],
    ];

    public function mount()
    {
        if (request()->has('tab')) {
            $this->activeTab = request('tab');
        }
        $this->flag = request()->get('flag', 'false');
    }

    // Reset page when search or perPage changes
    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedPerPage()
    {
        $this->resetPage();
    }

    // Sorting
    public function sortBy($field)
    {
        if ($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }
        $this->resetPage();
    }

    // Delete client
    public function delete($id)
    {
        Client::findOrFail($id)->delete();

        session()->flash('message', 'Client Deleted Successfully.');
        $this->resetPage();
    }

    public function render()
    {
        $clients = Client::query()
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%')
                      ->orWhere('code', 'like', '%' . $this->search . '%')
                      ->orWhere('phone', 'like', '%' . $this->search . '%');
            })
            ->orderBy($this->sortField, $this->sortDirection)
            ->paginate($this->perPage);

        return view('livewire.client.client-list', [
            'clients' => $clients,
        ])->layout('layouts.app', [
            'title' => 'Client',
            'sub_title' => 'Client List'
        ]);
    }
}