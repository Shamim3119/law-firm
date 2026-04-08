<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Auth\Login;


use App\Livewire\Dashboard\Dashboard;
use App\Livewire\Parameter\ParameterCrud;

use App\Livewire\Client\ClientList; 
use App\Livewire\Client\ClientForm;

use App\Livewire\Cases\CasesList; 
use App\Livewire\Cases\CasesForm;

use App\Livewire\Appointment\AppointmentList; 
use App\Livewire\Appointment\AppointmentForm;

use App\Livewire\Employee\EmployeeList; 
use App\Livewire\Employee\EmployeeForm;

 
 
Route::get('/', Login::class)->name('login');
Route::get('/login', Login::class)->name('login');

Route::middleware(['auth'])->group(function () {

    
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/parameter', ParameterCrud::class)->name('parameter.index');

 
    Route::get('/client', ClientList::class)->name('client.index');       
    Route::get('/client/form', ClientForm::class)->name('client.create');  
    Route::get('/client/form/{id}', ClientForm::class)->name('client.edit');  

 
    Route::get('/cases', CasesList::class)->name('cases.index');        
    Route::get('/cases/form', CasesForm::class)->name('cases.create');  
    Route::get('/cases/form/{id}', CasesForm::class)->name('cases.edit'); 

    Route::get('/appointment', AppointmentList::class)->name('appointment.index');      
    Route::get('/appointment/form', AppointmentForm::class)->name('appointment.create');  
    Route::get('/appointment/form/{id}', AppointmentForm::class)->name('appointment.edit'); 


    Route::get('/employee', EmployeeList::class)->name('employee.index');    
    Route::get('/employee/form', EmployeeForm::class)->name('employee.create');  
    Route::get('/employee/form/{id}', EmployeeForm::class)->name('employee.edit');  
 
 

    Route::post('/logout', function () {
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/login');
    })->name('logout');

});

 



 

 