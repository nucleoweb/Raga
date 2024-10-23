<?php

namespace App\Livewire\Pages;

use App\Exports\LandChargesExport;
use App\Imports\LandChargesImport;
use App\Models\LandCharge;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class LandCharges extends Component {
    public $landCharges = [];
    public $search = '';
    public $product_type, $service_type, $city_origin, $port_cfs_airport_name, $trucker, $allowed_carriers, $supplier, $supplier_charge_name, $cost, $min_cost, $max_cost, $unlocation_id, $goodstype, $effective_date, $expire_date, $sell_rate, $internal_notes, $external_notes, $charge_type, $min_weight, $max_weight, $min_size, $max_size;
    public $selectedLandCharge;

    public $csvName;

    protected $rules = [
        'product_type' => 'required|string|max:100',
        'service_type' => 'required|string|max:100',
        'city_origin' => 'required|string|max:100',
        'port_cfs_airport_name' => 'nullable|string|max:150',
        'supplier_charge_name' => 'required|string|max:150',
        /*'trucker' => 'nullable|string|max:100',
        'allowed_carriers' => 'nullable|string|max:150',
        'supplier' => 'nullable|string|max:150',
        'supplier_charge_name' => 'required|string|max:150',
        'cost' => 'nullable|numeric',
        'min_cost' => 'nullable|numeric',
        'max_cost' => 'nullable|numeric',
        'unlocation_id' => 'nullable|string|max:50',
        'goodstype' => 'nullable|string|max:100',
        'effective_date' => 'nullable|date',
        'expire_date' => 'nullable|date',
        'sell_rate' => 'nullable|string|max:255',
        'internal_notes' => 'nullable|string',
        'external_notes' => 'nullable|string',
        'charge_type' => 'nullable|string',
        'min_weight' => 'nullable|string|max:255',
        'max_weight' => 'nullable|string|max:255',
        'min_size' => 'nullable|numeric',
        'max_size' => 'nullable|numeric',*/
    ];

    public function mount() {
        $this->landCharges = LandCharge::latest()->get();
    }

    public function updatedSearch() {
        if (empty($this->search)) {
            $this->landCharges = LandCharge::latest()->get();
        } else {
            $this->landCharges = LandCharge::where(function($query) {
                $query->where('product_type', 'like', '%' . $this->search . '%')
                    ->orWhere('service_type', 'like', '%' . $this->search . '%')
                    ->orWhere('country_name', 'like', '%' . $this->search . '%')
                    ->orWhere('port_cfs_airport_name', 'like', '%' . $this->search . '%')
                    ->orWhere('trucker', 'like', '%' . $this->search . '%');
            })
                ->where('supplier_charge_name', 'like', '%IMPO%')
                ->get();
        }
    }

    public function save() {
        $this->validate();

        LandCharge::create([
            'product_type' => $this->product_type,
            'service_type' => $this->service_type,
            'country_name' => $this->city_origin,
            'port_cfs_airport_name' => $this->port_cfs_airport_name,
            'trucker' => $this->trucker,
            'allowed_carriers' => $this->allowed_carriers,
            'supplier' => $this->supplier,
            'supplier_charge_name' => $this->supplier_charge_name,
            'cost' => $this->cost,
            'min_cost' => $this->min_cost,
            'max_cost' => $this->max_cost,
            'unlocation_id' => $this->unlocation_id,
            'goodstype' => $this->goodstype,
            'effective_date' => $this->effective_date,
            'expire_date' => $this->expire_date,
            'sell_rate' => $this->sell_rate,
            'internal_notes' => $this->internal_notes,
            'external_notes' => $this->external_notes,
            'charge_type' => $this->charge_type,
            'min_weight' => $this->min_weight,
            'max_weight' => $this->max_weight,
            'min_size' => $this->min_size,
            'max_size' => $this->max_size,
        ]);

        session()->flash('message', 'Land Charge created successfully.');

        $this->reset();

        return redirect()->to('/land-charges');
    }

    public function uploadLandCharges() {
        $this->validate([
            'csv' => 'required|file|mimes:csv,txt',
        ]);

        Excel::import(new  LandChargesImport(), $this->csv->getRealPath());

        session()->flash('message', 'CSV file imported successfully.');
    }

    public function exportLandCharges() {
        $date = now()->format('Y-m-d_H-i-s');
        $fileName = 'land_charges_' . $date . '.xlsx';

        return Excel::download(new LandChargesExport(), $fileName);
    }

    public function updateLandCharge() {
        $this->validate();

        $this->selectedLandCharge->update([
            'product_type' => $this->product_type,
            'service_type' => $this->service_type,
            'country_name' => $this->city_origin,
            'port_cfs_airport_name' => $this->port_cfs_airport_name,
            'trucker' => $this->trucker,
            'allowed_carriers' => $this->allowed_carriers,
            'supplier' => $this->supplier,
            'supplier_charge_name' => $this->supplier_charge_name,
            'cost' => $this->cost,
            'min_cost' => $this->min_cost,
            'max_cost' => $this->max_cost,
            'unlocation_id' => $this->unlocation_id,
            'goodstype' => $this->goodstype,
            'effective_date' => $this->effective_date,
            'expire_date' => $this->expire_date,
            'sell_rate' => $this->sell_rate,
            'internal_notes' => $this->internal_notes,
            'external_notes' => $this->external_notes,
            'charge_type' => $this->charge_type,
            'min_weight' => $this->min_weight,
            'max_weight' => $this->max_weight,
            'min_size' => $this->min_size,
            'max_size' => $this->max_size,
        ]);

        session()->flash('message', 'Port Charge updated successfully.');

        $this->reset();

        return redirect()->to('/land-charges');
    }

    public function editLandCharge($id) {
        $this->selectedLandCharge = LandCharge::findOrFail($id);
        $this->product_type = $this->selectedLandCharge->product_type;
        $this->service_type = $this->selectedLandCharge->service_type;
        $this->city_origin = $this->selectedLandCharge->country_name;
        $this->port_cfs_airport_name = $this->selectedLandCharge->port_cfs_airport_name;
        $this->trucker = $this->selectedLandCharge->trucker;
        $this->allowed_carriers = $this->selectedLandCharge->allowed_carriers;
        $this->supplier = $this->selectedLandCharge->supplier;
        $this->supplier_charge_name = $this->selectedLandCharge->supplier_charge_name;
        $this->cost = $this->selectedLandCharge->cost;
        $this->min_cost = $this->selectedLandCharge->min_cost;
        $this->max_cost = $this->selectedLandCharge->max_cost;
        $this->unlocation_id = $this->selectedLandCharge->unlocation_id;
        $this->goodstype = $this->selectedLandCharge->goodstype;
        $this->effective_date = $this->selectedLandCharge->effective_date;
        $this->expire_date = $this->selectedLandCharge->expire_date;
        $this->sell_rate = $this->selectedLandCharge->sell_rate;
        $this->internal_notes = $this->selectedLandCharge->internal_notes;
        $this->external_notes = $this->selectedLandCharge->external_notes;
        $this->charge_type = $this->selectedLandCharge->charge_type;
        $this->min_weight = $this->selectedLandCharge->min_weight;
        $this->max_weight = $this->selectedLandCharge->max_weight;
        $this->min_size = $this->selectedLandCharge->min_size;
        $this->max_size = $this->selectedLandCharge->max_size;
    }

    public function render() {
        return view('livewire.pages.land-charges')->layout('layouts.app');
    }
}
