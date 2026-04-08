<div> <!-- single root -->



<ul class="nav nav-tabs">

  <li class="nav-item">
    <a 
      class="nav-link {{ $activeTab == 'employees' ? 'active' : '' }}" 
      href="{{ route('employee.index', ['tab' => 'employees']) }}" 
       >
      Employees
    </a>
  </li>
</ul>
<br>  



<a href="{{ route('employee.create') }}" class="btn btn-primary mb-3">Add Employee</a>
<br>
@if (session()->has('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    <br>
@endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $employee)
            <tr>
                <td>{{ $employee->name }}</td>
                <td>{{ $employee->phone }}</td>
                <td>{{ $employee->email }}</td>
                <td>
                    <a href="{{ route('employee.edit', $employee->id) }}" class="btn btn-sm btn-warning">Edit</a>
               
                    <button 
                        wire:click="delete({{ $employee->id }})" 
                        onclick="confirm('Are you sure you want to delete this employee?') || event.stopImmediatePropagation()"
                        class="btn btn-danger btn-sm">
                        Delete
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


 