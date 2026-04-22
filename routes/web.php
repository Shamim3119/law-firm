<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Auth\Login;


use App\Livewire\Dashboard\Dashboard;
use App\Livewire\Parameter\ParameterCrud;

use App\Livewire\AttendanceSchedule\AttendanceScheduleCrud;

use App\Livewire\LeaveSchedule\LeaveScheduleCrud;
use App\Livewire\LeaveCalendar\LeaveCalendarCrud;
use App\Livewire\ProratedLeave\ProratedLeaveCrud;

use App\Livewire\Settings\BusinessCrud;
use App\Livewire\Settings\ProfileCrud;

use App\Livewire\Employee\EmployeeCrud; 
use App\Livewire\Client\ClientCrud; 

use App\Livewire\Appointment\AppointmentList; 
use App\Livewire\Appointment\AppointmentForm; 
 

use App\Livewire\Cases\CasesList; 
use App\Livewire\Cases\CasesForm;

use App\Http\Controllers\PdfController;
 


 

 
 
Route::get('/', Login::class)->name('login');
Route::get('/login', Login::class)->name('login');

Route::middleware(['auth'])->group(function () {

    
    Route::get('/pdf', [PdfController::class, 'generate'])->name('pdf');

    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/parameter', ParameterCrud::class)->name('parameter.index');
    
    Route::get('/attendance-schedule', AttendanceScheduleCrud::class)->name('attendance-schedule.index');

    Route::get('/leave-schedule', LeaveScheduleCrud::class)->name('leave-schedule.index');
    Route::get('/prorated_leave', ProratedLeaveCrud::class)->name('prorated-leave.index');
    Route::get('/leave-calendar', LeaveCalendarCrud::class)->name('leave-calendar.index');

       
 

    Route::get('/employee', EmployeeCrud::class)->name('employee.index');  
    Route::get('/client', ClientCrud::class)->name('client.index'); 

    Route::get('/profile', ProfileCrud::class)->name('profile.index');
    Route::get('/bussiness', BusinessCrud::class)->name('bussiness.index');
    
    
    Route::get('/appointment', AppointmentList::class)->name('appointment.index');   
    Route::get('/appointment/form', AppointmentForm::class)->name('appointment.create');  
    Route::get('/appointment/form/{id}', AppointmentForm::class)->name('appointment.edit'); 


 
    Route::get('/cases', CasesList::class)->name('cases.index');        
    Route::get('/cases/form', CasesForm::class)->name('cases.create');  
    Route::get('/cases/form/{id}', CasesForm::class)->name('cases.edit'); 

   
   // Route::get('/appointment/form', AppointmentForm::class)->name('appointment.create');  
   // Route::get('/appointment/form/{id}', AppointmentForm::class)->name('appointment.edit'); 

    //Route::get('/client/form', ClientForm::class)->name('client.create');  
    //Route::get('/client/form/{id}', ClientForm::class)->name('client.edit');  
    //Route::get('/employee/form', EmployeeForm::class)->name('employee.create');  
    //Route::get('/employee/form/{id}', EmployeeForm::class)->name('employee.edit');  
 
 

    Route::post('/logout', function () {
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    })->name('logout');

});

 



 

 