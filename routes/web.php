<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Pages\Uploads;


Route::view('/', 'welcome');

Route::get('/logs', \App\Livewire\Pages\Logs::class)
    ->middleware(['auth'])
    ->name('logs');

Route::get('/uploads', Uploads::class)
	->middleware(['auth'])
	->name('uploads');

Route::get('/configs', App\Livewire\Config\ConfigIndex::class)
    ->middleware(['auth'])
    ->name('configs');

Route::get('/land-charges', \App\Livewire\Pages\LandCharges::class)
    ->middleware(['auth'])
    ->name('land-charges');

Route::get('/port-charges', \App\Livewire\Pages\PortCharges::class)
    ->middleware(['auth'])
    ->name('port-charges');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
