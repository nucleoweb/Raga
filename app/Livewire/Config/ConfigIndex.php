<?php

namespace App\Livewire\Config;

use App\Models\Config;
use Livewire\Component;

class ConfigIndex extends Component {
    public $prompt;

    public function mount() {
        $config = Config::first();

        if ($config) {
            $this->prompt = $config->prompt;
        }
    }


    public function save() {
        $this->validate([
            'prompt' => 'required',
        ]);

        // Check if a record exists
        $config = Config::first();

        if ($config) {
            // Update the existing record
            $config->update(['prompt' => $this->prompt]);
        } else {
            // Insert a new record
            Config::create(['prompt' => $this->prompt]);
        }
    }
    public function render() {
        return view('livewire.config.config-index')->layout('layouts.app');
    }
}
