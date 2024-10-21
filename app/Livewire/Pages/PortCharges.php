<?php

namespace App\Livewire\Pages;

use App\Exports\PortChargesExport;
use App\Imports\PortChargesImport;
use App\Models\PortCharge;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class PortCharges extends Component {
    public $portCharges = [];
    public $search = '';
    public $product_type, $service_type, $origin_country, $pol, $pod, $dest_country, $carrier, $supplier_charge_name, $calculation_rule, $cost, $currency, $goodstype, $effective_date, $expire_date, $sell_rate, $internal_notes, $external_notes, $min_weight, $max_weight, $min_size, $max_size;

    public $selectedPortCharge;

    public $csvName;

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
            'dest_country' => $this->dest_country,
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
            'max_size' => $this->max_size,
        ]);

        session()->flash('message', 'Port Charge created successfully.');

        $this->reset();

        return redirect()->to('/port-charges');
    }

    public function updatePortCharge() {
        $this->validate();

        $this->selectedPortCharge->update([
            'product_type' => $this->product_type,
            'service_type' => $this->service_type,
            'origin_country' => $this->origin_country,
            'pol' => $this->pol,
            'pod' => $this->pod,
            'dest_country' => $this->dest_country,
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
            'max_size' => $this->max_size,
        ]);

        session()->flash('message', 'Port Charge updated successfully.');

        $this->reset();

        return redirect()->to('/port-charges');
    }

    public function mount() {
        $this->portCharges = PortCharge::latest()->get();
    }

    public function uploadPortCharges() {
        $this->validate([
            'csv' => 'required|file|mimes:csv,txt',
        ]);

        Excel::import(new  PortChargesImport(), $this->csv->getRealPath());

        session()->flash('message', 'CSV file imported successfully.');
    }

    public function exportPortCharges() {
        $date = now()->format('Y-m-d_H-i-s');
        $fileName = 'port_charges_' . $date . '.xlsx';

        return Excel::download(new PortChargesExport(), $fileName);
    }

    public function editPortCharge($id) {
        $this->selectedPortCharge = PortCharge::findOrFail($id);
        $this->product_type = $this->selectedPortCharge->product_type;
        $this->service_type = $this->selectedPortCharge->service_type;
        $this->origin_country = $this->selectedPortCharge->origin_country;
        $this->pol = $this->selectedPortCharge->pol;
        $this->pod = $this->selectedPortCharge->pod;
        $this->dest_country = $this->selectedPortCharge->dest_country;
        $this->carrier = $this->selectedPortCharge->carrier;
        $this->supplier_charge_name = $this->selectedPortCharge->supplier_charge_name;
        $this->calculation_rule = $this->selectedPortCharge->calculation_rule;
        $this->cost = $this->selectedPortCharge->cost;
        $this->currency = $this->selectedPortCharge->currency;
        $this->goodstype = $this->selectedPortCharge->goodstype;
        $this->effective_date = $this->selectedPortCharge->effective_date;
        $this->expire_date = $this->selectedPortCharge->expire_date;
        $this->sell_rate = $this->selectedPortCharge->sell_rate;
        $this->internal_notes = $this->selectedPortCharge->internal_notes;
        $this->external_notes = $this->selectedPortCharge->external_notes;
        $this->min_weight = $this->selectedPortCharge->min_weight;
        $this->max_weight = $this->selectedPortCharge->max_weight;
        $this->min_size = $this->selectedPortCharge->min_size;
        $this->max_size = $this->selectedPortCharge->max_size;
    }

    public function render() {
        return view('livewire.pages.port-charges')->layout('layouts.app');
    }
}
