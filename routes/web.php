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

Route::get('/dashboard', \App\Livewire\Pages\MarginsIndex::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/users', \App\Livewire\Pages\UsersIndex::class)
    ->middleware(['auth', 'verified'])
    ->name('users');

Route::get('/users/register', \App\Livewire\Pages\UserCreate::class)
    ->middleware(['auth', 'verified'])
    ->name('users.create');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::view('email-response', 'emails.response')
    ->middleware(['auth'])
    ->name('email-response');

require __DIR__.'/auth.php';
