<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Pages\Uploads;


Route::view('/', 'welcome');
Route::get('/uploads', Uploads::class)
	->middleware(['auth'])
	->name('uploads');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
