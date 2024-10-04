<?php

namespace App\Livewire\Pages;

use App\Models\User;
use Livewire\Component;

class UsersIndex extends Component {
    public $users = [];

    public function mount() {
        $this->users = User::all();
    }

    public function render() {
        return view('livewire.pages.users-index')->layout('layouts.app');
    }
}
