<?php

namespace App\Livewire\Pages;

use App\Models\PortCharge;
use Livewire\Component;

class PortCharges extends Component {
    public $portCharges = [];
    public $search = '';
    public $product_type, $service_type, $origin_country, $pol, $pod, $dest_country, $carrier, $supplier_charge_name, $calculation_rule, $cost, $currency, $goodstype, $effective_date, $expire_date, $sell_rate, $internal_notes, $external_notes, $min_weight, $max_weight, $min_size, $max_size;

    protected $rules = [
        'product_type' => 'required|string|max:100',
        'service_type' => 'required|string|max:100',
        'origin_country' => 'required|string|max:100',
        'pol' => 'nullable|string|max:100',
        'pod' => 'nullable|string|max:100',
        'dest_country' => 'nullable|string|max:100',
        'carrier' => 'nullable|string|max:100',
        'supplier_charge_name' => 'nullable|string|max:150',
        'calculation_rule' => 'nullable|string|max:100',
        'cost' => 'nullable|numeric',
        'currency' => 'nullable|string|max:10',
        'goodstype' => 'nullable|string|max:100',
        'effective_date' => 'nullable|date',
        'expire_date' => 'nullable|date',
        'sell_rate' => 'nullable|string|max:255',
        'internal_notes' => 'nullable|string',
        'external_notes' => 'nullable|string',
        'min_weight' => 'nullable|string|max:255',
        'max_weight' => 'nullable|string|max:255',
        'min_size' => 'nullable|numeric',
        'max_size' => 'nullable|numeric',
    ];

    public function updatedSearch() {
        if (empty($this->search)) {
            $this->portCharges = PortCharge::latest()->get();
        } else {
            $this->portCharges = PortCharge::where('product_type', 'like', '%' . $this->search . '%')
                ->orWhere('service_type', 'like', '%' . $this->search . '%')
                ->orWhere('origin_country', 'like', '%' . $this->search . '%')
                ->orWhere('pol', 'like', '%' . $this->search . '%')
                ->orWhere('pod', 'like', '%' . $this->search . '%')
                ->get();
        }
    }

    public function save() {
        $this->validate();

        PortCharge::create([
            'product_type' => $this->product_type,
            'service_type' => $this->service_type,
            'origin_country' => $this->origin_country,
            'pol' => $this->pol,
            'pod' => $this->pod,
            /*'dest_country' => $this->dest_country,
            'carrier' => $this->carrier,
            'supplier_charge_name' => $this->supplier_charge_name,
            'calculation_rule' => $this->calculation_rule,
            'cost' => $this->cost,
            'currency' => $this->currency,
            'goodstype' => $this->goodstype,
            'effective_date' => $this->effective_date,
            'expire_date' => $this->expire_date,
            'sell_rate' => $this->sell_rate,
            'internal_notes' => $this->internal_notes,
            'external_notes' => $this->external_notes,
            'min_weight' => $this->min_weight,
            'max_weight' => $this->max_weight,
            'min_size' => $this->min_size,
            'max_size' => $this->max_size,*/
        ]);

        session()->flash('message', 'Port Charge created successfully.');

        $this->reset();

        return redirect()->to('/port-charges');
    }
    public function mount() {
        $this->portCharges = PortCharge::latest()->get();
    }
    public function render() {
        return view('livewire.pages.port-charges')->layout('layouts.app');
    }
}
