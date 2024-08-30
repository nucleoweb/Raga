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
				'product_type' => $row[0],
				'service_type' => $row[1],
				'country_name' => $row[2],
				'port_cfs_airport_name' => $row[3],
				'trucker' => $row[4],
				'allowed_carriers' => $row[5],
				'supplier' => $row[6],
				'inland_service_reference_contract' => $row[7],
				'supplier_charge_name' => $row[8],
				'internal_charge_name' => $row[9] ?? 'Default Charge Name',
				'cost' => $row[10],
				'min_cost' => $row[11],
				'max_cost' => $row[12],
				'currency' => $row[13],
				'distance_range_from' => $this->transformDecimal($row[14]),
				'distance_range_to' => $this->transformDecimal($row[15]),
				'range_from' => $this->transformDecimal($row[16]),
				'range_to' => $this->transformDecimal($row[17]),
				'zip_code' => $row[18],
				'unlocation_id' => $row[19],
				'wm_factor' => $row[20],
				'goodstype' => $row[21],
				'rate_applicability' => $row[22],
				'publish_date' => $this->transformDate($row[23]) ?? now(),
				'effective_date' => $this->transformDate($row[24]) ?? now(),
				'expire_date' => $this->transformDate($row[25]) ?? now(),
				'sell_rate' => $this->transformDecimal($row[26]),
				'internal_notes' => $row[27],
				'external_notes' => $row[28],
				'pricing_notes' => $row[29],
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
