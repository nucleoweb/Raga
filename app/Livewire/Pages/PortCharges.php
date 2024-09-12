<?php

namespace App\Livewire\Pages;

use App\Models\PortCharge;
use Livewire\Component;

class PortCharges extends Component {
    public $portCharges = [];

    public function mount() {
        $this->portCharges = PortCharge::all();
    }
    public function render() {
        return view('livewire.pages.port-charges')->layout('layouts.app');
    }
}
