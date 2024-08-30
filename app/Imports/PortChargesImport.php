<?php
	
	namespace App\Imports;
	
	use App\Models\PortCharge;
	use Maatwebsite\Excel\Concerns\ToModel;
	
	class PortChargesImport implements ToModel
	{
		/**
		 * @param array $row
		 *
		 * @return \Illuminate\Database\Eloquent\Model|null
		 */
		public function model(array $row) {
			return new PortCharge([
				'product_type' => $row[0],
				'service_type' => $row[1],
				'origin_country' => $row[2],
				'pol' => $row[3],
				'via' => $row[4],
				'pod' => $row[5],
				'dest_country' => $row[6],
				'carrier' => $row[7],
				'supplier' => $row[8],
				'supplier_charge_name' => $row[9],
				'internal_charge_name' => $row[10],
				'calculation_rule' => $row[11],
				'cost' => $this->transformDecimal($row[12]),
				'currency' => $row[13],
				'goodstype' => $row[14],
				'publish_date' => $this->transformDate($row[15]),
				'effective_date' => $this->transformDate($row[16]),
				'expire_date' => $this->transformDate($row[17]),
				'sell_rate' => $this->transformDecimal($row[18]),
				'internal_notes' => $row[19],
				'external_notes' => $row[20],
				'pricing_notes' => $row[21],
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
