<?php

	namespace App\Imports;

	use App\Models\LandCharge;
	use Maatwebsite\Excel\Concerns\ToModel;

	class LandChargesImport implements ToModel
	{
		/**
		 * @param array $row
		 *
		 * @return \Illuminate\Database\Eloquent\Model|null
		 */
		public function model(array $row)
		{
			return new LandCharge([
                'product_type' => $row[0] ?? null,
                'service_type' => $row[1] ?? null,
                'country_name' => $row[2] ?? null,
                'port_cfs_airport_name' => $row[3] ?? null,
                'trucker' => $row[4] ?? null,
                'allowed_carriers' => $row[5] ?? null,
                'supplier' => $row[6] ?? null,
                'supplier_charge_name' => $row[7] ?? null,
                'cost' => $this->transformDecimal($row[8]) ?? null,
                'min_cost' => $this->transformDecimal($row[9]) ?? null,
                'max_cost' => $this->transformDecimal($row[10])?? null,
                'unlocation_id' => $row[11] ?? null,
                'goodstype' => $row[12] ?? null,
                'effective_date' => $this->transformDate($row[13]) ?? null,
                'expire_date' => $this->transformDate($row[14]) ?? null,
                'sell_rate' => $row[15] ?? null,
                'internal_notes' => $row[16] ?? null,
                'external_notes' => $row[17] ?? null,
                'charge_type' => $row[18] ?? null,
                'min_weight' => $row[19] ?? null,
                'max_weight' => $row[20] ?? null,
                'min_size' => $this->transformDecimal($row[21]) ?? null,
                'max_size' => $this->transformDecimal($row[22]) ?? null,
			]);
		}

		public function transformDate($value, $format = 'Y-m-d') {
			try {
				return \Carbon\Carbon::createFromFormat('Y-m-d', $value)->format($format);
			} catch (\Exception $e) {
				return null;
			}
		}

		public function transformDecimal($value) {
			$value = str_replace(',', '.', $value);
			return is_numeric($value) ? (float) $value : null;
		}
	}
