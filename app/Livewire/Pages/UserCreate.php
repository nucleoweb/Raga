<?php

namespace App\Livewire\Pages;

use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use App\Models\User;
use Illuminate\Validation\Rules;

class UserCreate extends Component {
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $selectRole;
    public $roles = ['Administrador', 'Pricing', 'Operador logístico'];
    public function register() {
        $validated  = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        $user->assignRole($this->selectRole);

        return redirect()->to('/users');
    }
    public function render() {
        return view('livewire.pages.user-create')->layout('layouts.app');
    }
}
