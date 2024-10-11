<?php

namespace App\Livewire\Pages;

use App\Models\LandCharge;
use App\Models\Margins;
use Livewire\Component;
use Illuminate\Database\Eloquent\Collection;

class LandCharges extends Component {
    public Collection $landCharges;
    public $search = '';
    public $product_type, $service_type, $city_origin, $port_cfs_airport_name, $trucker, $allowed_carriers, $supplier, $supplier_charge_name, $cost, $min_cost, $max_cost, $unlocation_id, $goodstype, $effective_date, $expire_date, $sell_rate, $internal_notes, $external_notes, $charge_type, $min_weight, $max_weight, $min_size, $max_size;

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
            $this->landCharges = LandCharge::where('product_type', 'like', '%' . $this->search . '%')
                ->orWhere('service_type', 'like', '%' . $this->search . '%')
                ->orWhere('city_origin', 'like', '%' . $this->search . '%')
                ->orWhere('port_cfs_airport_name', 'like', '%' . $this->search . '%')
                ->orWhere('supplier_charge_name', 'like', '%' . $this->search . '%')
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

    public function render() {
        return view('livewire.pages.land-charges')->layout('layouts.app');
    }
}
