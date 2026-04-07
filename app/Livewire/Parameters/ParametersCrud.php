<?php

namespace App\Livewire\Parameters;

use Livewire\Component;
use App\Models\Parameters;

class ParametersCrud extends Component
{

    public $parameters, $name, $tag, $parameter_id;
    public $updateMode = false;


    public function render()
    {
        $this->parameters = Parameters::all(); 
        // return view('livewire.parameters.parameters-crud');
        return view('livewire.parameters.parameters-crud')->layout('layouts.app');
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->tag = '';
        $this->parameter_id = '';
    }

    public function store()
    {
        $validatedData = $this->validate([
            'name' => 'required|string',
            'tag' => 'required|string',
        ]);

        Parameters::updateOrCreate(['id' => $this->parameter_id], $validatedData);
        session()->flash('message', 
            $this->parameter_id ? 'Parameter Updated Successfully.' : 'Parameter Created Successfully.');

        $this->resetInputFields();
        $this->updateMode = false;
    }

    public function edit($id)
    {
        $parameter = Parameters::findOrFail($id);
        $this->parameter_id = $id;
        $this->name = $parameter->name;
        $this->tag = $parameter->tag;
        $this->updateMode = true;
    }

    public function delete($id)
    {
        Parameters::find($id)->delete();
        session()->flash('message', 'Parameter Deleted Successfully.');
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }
}

 

 