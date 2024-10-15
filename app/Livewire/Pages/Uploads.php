<?php

	namespace App\Livewire\Pages;

	use App\Imports\InlandMerchantImport;
	use App\Imports\LandChargesImport;
	use App\Imports\MarginsImport;
	use App\Imports\PortChargesImport;
	use Illuminate\Support\Facades\DB;
	use Livewire\Component;
	use Livewire\WithFileUploads;
	use Maatwebsite\Excel\Facades\Excel;

	class Uploads extends Component {
		use WithFileUploads;

		public $csv;

		public function uploadPortCharges() {
			$this->validate([
				'csv' => 'required|file|mimes:csv,txt',
			]);


			Excel::import(new PortChargesImport, $this->csv->getRealPath());

			session()->flash('message', 'CSV file imported successfully.');
		}

		public function uploadLandCharges() {
			$this->validate([
				'csv' => 'required|file|mimes:csv,txt',
			]);

			Excel::import(new  LandChargesImport(), $this->csv->getRealPath());

			session()->flash('message', 'CSV file imported successfully.');
		}

		public function uploadInlandMerchant() {
			$this->validate([
				'csv' => 'required|file|mimes:csv,txt',
			]);

			Excel::import(new  InlandMerchantImport(), $this->csv->getRealPath());

			session()->flash('message', 'CSV file imported successfully.');
		}

		public function uploadMargins() {
			$this->validate([
				'csv' => 'required|file|mimes:csv,txt',
			]);

			Excel::import(new  MarginsImport(), $this->csv->getRealPath());

			session()->flash('message', 'CSV file imported successfully.');
		}

		public function render() {
			return view('livewire.pages.uploads')->layout('layouts.app');
		}
	}
