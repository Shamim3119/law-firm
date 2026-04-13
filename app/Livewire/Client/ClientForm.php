<?php

 
namespace App\Livewire\Client;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\Client;
use Illuminate\Support\Facades\DB;

class ClientForm extends Component
{
    public $client_id;
    public $name, $phone, $email;

    public function mount($id = null)
    {
        if ($id) {
            $client = Client::findOrFail($id);
            $this->client_id = $client->id;
            $this->name = $client->name;
            $this->phone = $client->phone;
            $this->email = $client->email;
        }
    }

    public function save()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        /*
        Client::updateOrCreate(
            ['id' => $this->client_id],
            [
                'name' => $this->name,
                'phone' => $this->phone,
                'email' => $this->email,
            ]
        );
        */

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

        session()->flash('message', $this->client_id ? 'Client Updated Successfully' : 'Client Created Successfully');

        return redirect()->route('client.index', ['tab' => 'clients', 'flag' => 'true']);
    }

    public function render()
    {
        return view('livewire.client.client-form')->layout('layouts.app', [
            'title' => $this->client_id ? 'Edit Client' : 'Add Client',
            'sub_title' => 'Client Form'
        ]);
    }

    public function delete($id)
    {
        Client::findOrFail($id)->delete();

        session()->flash('message', 'Client Deleted Successfully');
    }
}