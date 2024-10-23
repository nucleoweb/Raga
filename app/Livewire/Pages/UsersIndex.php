<?php

namespace App\Livewire\Pages;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Illuminate\Validation\Rules;

class UsersIndex extends Component {
    public $users = [];
    public $search = '';
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $selectRole;
    public $selectedUser;
    public $roles = ['Administrador', 'Pricing', 'Operador logístico'];

    public function mount() {
        $this->users = User::latest()->get();
    }

    public function updatedSearch() {
        if (empty($this->search)) {
            $this->users = User::latest()->get();
        } else {
            $this->users = User::where('name', 'like', '%' . $this->search . '%')
                ->orWhere('email', 'like', '%' . $this->search . '%')
                ->get();
        }
    }

    public function editUser($id) {
        $this->selectedUser = User::find($id);
        $this->name = $this->selectedUser->name;
        $this->email = $this->selectedUser->email;
        $this->selectRole = $this->selectedUser->roles->first()->name;
    }

    public function update() {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class.',email,'.$this->selectedUser->id],
        ]);

        if (!empty($this->password)) {
            $passwordValidation = $this->validate([
                'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            ]);

            $validated['password'] = Hash::make($this->password);
        }

        $this->selectedUser->update($validated);

        $this->selectedUser->syncRoles([$this->selectRole]);

        return redirect()->to('/users');
    }

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
        return view('livewire.pages.users-index')->layout('layouts.app');
    }
}
