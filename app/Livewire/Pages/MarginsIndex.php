<?php

namespace App\Livewire\Pages;

use App\Models\Margins;
use Livewire\Component;

class MarginsIndex extends Component {

    public $margins = [];
    public $search = '';
    public $product_type, $service_type, $country_name, $port_cfs_airport_name, $supplier, $agent_fee, $handling_fee, $documentation_fee, $total_margin, $effective_date, $expire_date, $internal_notes, $external_notes;

    protected $rules = [
        'product_type' => 'required|string|max:100',
        'service_type' => 'required|string|max:100',
        'country_name' => 'required|string|max:100',
        /*'port_cfs_airport_name' => 'nullable|string|max:150',
        'supplier' => 'nullable|string|max:150',
        'agent_fee' => 'nullable|numeric',
        'handling_fee' => 'nullable|numeric',
        'documentation_fee' => 'nullable|numeric',
        'total_margin' => 'nullable|numeric',
        'effective_date' => 'nullable|date',
        'expire_date' => 'nullable|date',
        'internal_notes' => 'nullable|string',
        'external_notes' => 'nullable|string',*/
    ];

    public function mount() {
        $this->margins = Margins::latest()->get();
    }

    public function updatedSearch() {
        if (empty($this->search)) {
            $this->margins = Margins::latest()->get();
        } else {
            $this->margins = Margins::where('product_type', 'like', '%' . $this->search . '%')
                ->orWhere('service_type', 'like', '%' . $this->search . '%')
                ->orWhere('country_name', 'like', '%' . $this->search . '%')
                ->orWhere('product_type', 'like', '%' . $this->search . '%')
                ->orWhere('internal_notes', 'like', '%' . $this->search . '%')
                ->get();
        }
    }

    public function save() {
        $this->validate();

        $margin = Margins::create([
            'product_type' => $this->product_type,
            'service_type' => $this->service_type,
            'country_name' => $this->country_name,
            'port_cfs_airport_name' => $this->port_cfs_airport_name,
            'supplier' => $this->supplier,
            'agent_fee' => $this->agent_fee,
            'handling_fee' => $this->handling_fee,
            'documentation_fee' => $this->documentation_fee,
            'total_margin' => $this->total_margin,
            'effective_date' => $this->effective_date,
            'expire_date' => $this->expire_date,
            'internal_notes' => $this->internal_notes,
            'external_notes' => $this->external_notes,
            'user_id' => auth()->id(),
        ]);

        session()->flash('message', 'Margin created successfully.');

        $this->reset();

        return redirect()->to('/dashboard');
    }
    public function render() {
        return view('livewire.pages.margins-index')->layout('layouts.app');
    }
}
