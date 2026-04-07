<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Auth\Login;
use App\Livewire\Parameters\ParametersCrud;


Route::get('/', function () {
    return view('welcome');
});





Route::get('/login', Login::class)->name('login');

Route::middleware(['auth'])->group(function () {

    Route::get('/parameters', ParametersCrud::class)->name('parameters');

    Route::post('/logout', function () {
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/login');
    })->name('logout');

});

 

// Route::get('parameters', ParametersCrud::class)->name('parameters');

 