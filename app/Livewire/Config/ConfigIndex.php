<?php

namespace App\Livewire\Config;

use App\Models\Config;
use Livewire\Component;

class ConfigIndex extends Component {
    public $prompt;
    public $promptResponse;

    public function mount() {
        $config = Config::first();

        if ($config) {
            $this->prompt = $config->prompt;
        }

        $this->promptResponse = $config->departure_prompt;
    }

    public function save() {
        $this->validate([
            'prompt' => 'required',
        ]);

        try {
            // Check if a record exists
            $config = Config::first();

            if ($config) {
                // Update the existing record
                $config->update(['prompt' => $this->prompt]);
            } else {
                // Insert a new record
                Config::create(['prompt' => $this->prompt]);
            }

            session()->flash('message', 'Prompt query guardado con éxito.');
            return redirect()->to(request()->header('Referer'));
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function savePromtpResponse() {
        $this->validate([
            'promptResponse' => 'required',
        ]);

        try {
            $config = Config::first();

            if ($config) {
                // Update the existing record
                $config->update(['departure_prompt' => $this->promptResponse]);
            } else {
                // Insert a new record
                Config::create(['departure_prompt' => $this->promptResponse]);
            }

            session()->flash('message', 'Prompt respuesta guardado con éxito.');
            return redirect()->to(request()->header('Referer'));
        } catch (\Exception $e) {
            session()->flash('error', $e->getMessage());
        }
    }

    public function render() {
        return view('livewire.config.config-index')->layout('layouts.app');
    }
}
