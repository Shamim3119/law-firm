<?php

namespace App\Livewire\Parameter;

use Livewire\Component;
use App\Models\Parameter;

class ParameterCrud extends Component
{
    public $parameters, $name, $parameter_id;
    public $updateMode = false;
    public $activeTab = 'religion';

    public function mount()
    {
        if (request()->has('tab')) {
            $this->activeTab = request('tab');
        }
    }

    public function render()
    {
        $this->parameters = Parameter::where('tag', $this->activeTab)->get();

        return view('livewire.parameter.parameter-crud')
            ->layout('layouts.app', [
                'title' => 'Parameters',
                'sub_title' => 'Parameters List'
            ]);
    }

    public function switchTab($tab)
    {
        $this->activeTab = $tab;
        $this->resetInputFields();
        $this->updateMode = false;
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->parameter_id = null;
    }

    public function store()
    {
        $validatedData = $this->validate([
            'name' => 'required|string',
        ]);

        $validatedData['tag'] = $this->activeTab;

        if ($this->parameter_id) {
            $parameter = Parameter::find($this->parameter_id);
            if ($parameter) {
                $parameter->update($validatedData);
                $this->dispatch('show-toast', message: ucfirst($this->activeTab) . ' Updated Successfully.');
            }
        } else {
            Parameter::create($validatedData);
            $this->dispatch('show-toast', message: ucfirst($this->activeTab) . ' Created Successfully.');
        }

        $this->resetInputFields();
        $this->updateMode = false;
    }

    public function edit($id)
    {
        $parameter = Parameter::findOrFail($id);

        $this->parameter_id = $id;
        $this->name = $parameter->name;
        $this->activeTab = $parameter->tag;
        $this->updateMode = true;

        $this->dispatch('open-edit-box');
    }

    public function delete($id)
    {
        Parameter::find($id)?->delete();
        session()->flash('message', 'Parameter Deleted Successfully.');
        $this->dispatch('show-toast', message: session('message'));
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }
}