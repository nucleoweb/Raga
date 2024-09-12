<?php

namespace App\Livewire\Pages;

use App\Models\LandCharge;
use Livewire\Component;
use Illuminate\Database\Eloquent\Collection;

class LandCharges extends Component {
    public Collection $landCharges;

    public function mount() {
        $this->landCharges = LandCharge::all();
    }

    public function render() {
        return view('livewire.pages.land-charges')->layout('layouts.app');
    }
}
