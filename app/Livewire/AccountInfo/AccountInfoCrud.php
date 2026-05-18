<?php

namespace App\Livewire\AccountInfo;

use Livewire\Component;
use Livewire\Attributes\On;

use App\Models\Parameter;
use App\Models\BankOperator;
use App\Models\AccountInfo;

class AccountInfoCrud extends Component
{
    public $ref_id;
    public $ref_type_id = 0;
    public $bank_types = [];
    public $banks = [];
    public $code;

    public $type_id;
    public $bank_id;

    public $account_no;
    public $name;
    public $description;
    public $inactive = 0;

    public $account_id;
    public $updateMode = false;

    #[On('setRefId')]
    public function setRefId($id, $type, $code)
    {
        $this->ref_id = $id;
        $this->ref_type_id = $type;
 
        if($type == '1') {
            $this->code = str_replace("EMP","EBK",$code);
        }elseif($type == '2') {
            $this->code = str_replace("CLI","CBK",$code);
        }elseif($type == '3') {
            $this->code = str_replace("BIF","BBK",$code);
        }  
        else {
            $this->code = $code;
        }   
 

        $this->resetInputFields();
    }

    public function mount()
    {
        $this->bank_types = Parameter::where('tag', 'bank-type')->get();
    }

    public function updatedTypeId($value)
    {
        $this->bank_id = '';
        $this->banks = BankOperator::where('type_id', $value)->get();
    }

    public function resetInputFields()
    {
        $this->account_id = null;
        $this->updateMode = false;

        $this->type_id = '';
        $this->bank_id = '';
        $this->account_no = '';
        $this->name = '';
        $this->description = '';
        $this->inactive = 0;

        $this->banks = [];
    }

    // ======================
    // EDIT FUNCTION
    // ======================
    public function edit($id)
    {
        $account = AccountInfo::findOrFail($id);

        $this->account_id = $account->id;
        $this->updateMode = true;

        $this->type_id = $account->type_id;

        // load banks for selected type
        $this->banks = BankOperator::where('type_id', $account->type_id)->get();

        $this->bank_id = $account->bank_id;

        $this->account_no = $account->account_no;
        $this->name = $account->name;
        $this->description = $account->description;
        $this->inactive = $account->inactive;
    }

    // ======================
    // UPDATE FUNCTION
    // ======================
    public function update()
    {
        $this->validate([
            'type_id' => 'required',
            'bank_id' => 'required',
            'account_no' => 'required',
            'name' => 'required',
        ]);

        $account = AccountInfo::findOrFail($this->account_id);

        $account->update([
            'type_id' => $this->type_id,
            'bank_id' => $this->bank_id,
            'account_no' => $this->account_no,
            'name' => $this->name,
            'description' => $this->description,
            'inactive' => $this->inactive ? 1 : 0,
        ]);


        $this->dispatch('show-toast', message: 'Account Updated Successfully.');

        $this->resetInputFields();
    }

    public function store()
    {
        if ($this->updateMode) {
            return $this->update();
        }

        $this->validate([
            'type_id' => 'required',
            'bank_id' => 'required',
            'account_no' => 'required',
            'name' => 'required',
        ]);

        AccountInfo::create([
            'ref_id' => $this->ref_id,
            'code' => $this->code,
            'ref_type_id' => $this->ref_type_id,
            'type_id' => $this->type_id,
            'bank_id' => $this->bank_id,
            'account_no' => $this->account_no,
            'name' => $this->name,
            'description' => $this->description,
            'inactive' => $this->inactive ? 1 : 0,
        ]);

 
        $this->dispatch('show-toast', message: 'Account Created Successfully.');

        $this->resetInputFields();
    }

    public function delete($id)
    {
        AccountInfo::findOrFail($id)->delete();

        $this->dispatch('show-toast', message: 'Account Deleted Successfully');
    }

    public function render()
    {
        $accounts = [];

        if ($this->ref_id) {
            $accounts = AccountInfo::where('ref_id', $this->ref_id)
                ->where('ref_type_id', $this->ref_type_id )
                ->orderBy('id', 'desc')
                ->get();
        }

        return view('livewire.account-info.account-info-crud', [
            'accounts' => $accounts
        ]);
    }
}