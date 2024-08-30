<?php
	
	namespace App\Imports;
	
	use App\Models\ExceptionCost;
	use Maatwebsite\Excel\Concerns\ToModel;
	
	class InlandMerchantImport implements ToModel
	{
		/**
		 * @param array $row
		 *
		 * @return \Illuminate\Database\Eloquent\Model|null
		 */
		public function model(array $row)
		{
			return new ExceptionCost([
				'template' => $row[0],
				'uuid' => $row[1],
				'customer_id' => $row[2],
				'product_type' => $row[3],
				'service_type' => $row[4],
				'country_name' => $row[5],
				'port_cfs_airport_name' => $row[6],
				'trucker' => $row[7],
				'allowed_carriers' => $row[8],
				'supplier' => $row[9],
				'inland_service_reference_contract' => $row[10],
				'supplier_charge_name' => $row[11],
				'internal_charge_name' => $row[12],
				'cost' => $this->transformDecimal($row[13]),
				'currency' => $row[14],
				'unlocation_id' => $row[15],
				'wm_factor' => $this->transformDecimal($row[16]),
				'goodstype' => $row[17],
				'rate_applicability' => $row[18],
				'publish_date' => $this->transformDate($row[19]),
				'effective_date' => $this->transformDate($row[20]),
				'expire_date' => $this->transformDate($row[21]),
				'sell_rate' => $this->transformDecimal($row[22]),
				'internal_notes' => $row[23],
				'external_notes' => $row[24],
				'pricing_notes' => $row[25],
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
