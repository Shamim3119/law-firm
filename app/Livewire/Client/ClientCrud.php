<?php

namespace App\Livewire\Client;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Client;
use Illuminate\Support\Facades\DB;

class ClientCrud extends Component
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


    public $updateMode = false;
    public $client_id;
    public $name, $phone, $email;
 
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

        return view('livewire.client.client-crud', [
            'clients' => $clients,
        ])->layout('layouts.app', [
            'title' => 'Client',
            'sub_title' => 'Client List'
        ]);
    }

    public function save()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        if ($this->client_id) {
            $client = Client::findOrFail($this->client_id);
            $client->update([
                'name' => $this->name,
                'phone' => $this->phone,
                'email' => $this->email,
            ]);
        }else{
            
            $appointmentCode = DB::select("SELECT fnc_get_code(1) as code")[0]->code;
            $client = Client::create([
                'name' => $this->name,
                'phone' => $this->phone,
                'email' => $this->email,
                'code' => $appointmentCode,
            ]);
        }
         
        $this->dispatch('show-toast', message: $this->client_id ? 'Client Updated Successfully' : 'Client Created Successfully');

        $this->resetInputFields();

        $this->updateMode = false;

    }

    public function edit($id)
    {
        if ($id) {
            $client = Client::findOrFail($id);
            $this->client_id = $id;
            $this->name = $client->name;
            $this->phone = $client->phone;
            $this->email = $client->email;
            $this->updateMode = true;
            $this->dispatch('open-edit-box');
        }
    }

    private function resetInputFields()
    {
        $this->client_id = null;
        $this->name = '';
        $this->phone = '';
        $this->email = '';
    }


    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }
}