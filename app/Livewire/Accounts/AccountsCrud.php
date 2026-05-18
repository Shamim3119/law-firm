<?php

namespace App\Livewire\Accounts;

use Livewire\Component;
use Livewire\WithPagination;

use App\Models\Employee;
use App\Models\Client;
use App\Models\Business;
use App\Models\AccountInfo;

use Illuminate\Support\Facades\DB;

class AccountsCrud extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $account_id;
    public $source_table;

    public $code;
    public $name;
    public $description;
    public $inactive = 0;

    public $updateMode = false;
    public $activeTab = 'accounts';

    public $perPage = 10;
    public $search = '';
    public $page = 1;

    public $sortField = 'id';
    public $sortDirection = 'desc';

    public $flag = 'false';

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
    }

    private function resetInputFields()
    {
        $this->account_id = null;
        $this->source_table = null;

        $this->code = '';
        $this->name = '';
        $this->description = '';
        $this->inactive = 0;
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }

    public function updatedPerPage()
    {
        $this->resetPage();
    }

    public function sortBy($field)
    {
        if ($this->sortField == $field) {
            $this->sortDirection =
                $this->sortDirection == 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortField = $field;
            $this->sortDirection = 'asc';
        }

        $this->resetPage();
    }

public function render()
{
    $employees = Employee::query()
        ->select(
            'id',
            'code',
            'name',
            'balance'
        )
        ->selectRaw('0 as inactive')
        ->selectRaw("'Cash' as acc_type")
        ->selectRaw("'Employee' as type")
        ->selectRaw("'employees' as source_table")
        ->selectRaw('1 as type_id');

    $clients = Client::query()
        ->select(
            'id',
            'code',
            'name',
            'balance'
        )
        ->selectRaw('0 as inactive')
        ->selectRaw("'Cash' as acc_type")
        ->selectRaw("'Client' as type")
        ->selectRaw("'clients' as source_table")
        ->selectRaw('2 as type_id');

    $businesses = Business::query()
        ->select(
            'id',
            'code',
            'name',
            'balance'
        )
        ->selectRaw('0 as inactive')
        ->selectRaw("'Cash' as acc_type")
        ->selectRaw("'Business' as type")
        ->selectRaw("'businesses' as source_table")
        ->selectRaw('3 as type_id');

    $account_info = AccountInfo::query()
        ->select(
            'id',
            'code',
            'name',
            'balance',
            'inactive'
        )
        ->selectRaw("
            CASE
                WHEN ref_type_id = 0 THEN 'UD Account'
                ELSE 'Bank'
            END as acc_type
        ")
        ->selectRaw("
            CASE
                WHEN ref_type_id = 0 THEN 'Define'
                ELSE 'Bank'
            END as type
        ")
        ->selectRaw("'account_infos' as source_table")
        ->selectRaw('ref_type_id as type_id');

    // Merge all queries
    $unionQuery = $employees
        ->unionAll($clients)
        ->unionAll($businesses)
        ->unionAll($account_info);

    // Final query with search/sort/pagination
    $accounts = DB::query()
        ->fromSub($unionQuery, 'accounts')

        // Search
        ->when($this->search, function ($query) {

            $query->where(function ($q) {

                $q->where('name', 'like', '%' . $this->search . '%')
                    ->orWhere('code', 'like', '%' . $this->search . '%')
                    ->orWhere('acc_type', 'like', '%' . $this->search . '%');

            });

        })

        // Sorting
        ->orderBy(
            $this->sortField ?? 'id',
            $this->sortDirection ?? 'desc'
        )

        // Pagination
        ->paginate($this->perPage ?? 10);

    return view('livewire.accounts.accounts-crud', [

        'accounts' => $accounts,

    ])->layout('layouts.app', [

        'title' => 'Accounting',
        'sub_title' => 'Accounts List'

    ]);
}

    public function create()
    {
        $this->resetInputFields();

        $this->code = DB::select(
            "SELECT fnc_get_code(4) as code"
        )[0]->code;

        $this->updateMode = true;
    }

    public function store()
    {
        $validatedData = $this->validate([
            'name' => 'required|string',
            'code' => 'required|string',
            'description' => 'nullable|string',
            'inactive' => 'required|boolean',
        ]);

        if ($this->account_id) {

            $account = AccountInfo::find($this->account_id);

            if ($account) {
                $account->update($validatedData);

                $this->dispatch(
                    'show-toast',
                    message: 'Account Updated Successfully.'
                );
            }

        } else {

            AccountInfo::create($validatedData);

            $this->dispatch(
                'show-toast',
                message: 'Account Created Successfully.'
            );
        }

        $this->resetInputFields();

        $this->updateMode = false;
    }

    public function edit($id, $source_table)
    {
        if ($source_table != 'account_infos') {
            $this->dispatch(
                'show-toast',
                message: 'Only AccountInfo editable.'
            );

            return;
        }

        $account = AccountInfo::findOrFail($id);

        $this->account_id = $account->id;

        $this->name = $account->name;
        $this->code = $account->code;
        $this->description = $account->description;
        $this->inactive = $account->inactive;

        $this->updateMode = true;
    }

    public function delete($id, $source_table)
    {
        if ($source_table != 'account_infos') {

            $this->dispatch(
                'show-toast',
                message: 'Only AccountInfo deletable.'
            );

            return;
        }

        AccountInfo::find($id)?->delete();

        $this->dispatch(
            'show-toast',
            message: 'Account Deleted Successfully.'
        );

        $this->resetPage();
    }

    public function cancel()
    {
        $this->updateMode = false;

        $this->resetInputFields();
    }
}