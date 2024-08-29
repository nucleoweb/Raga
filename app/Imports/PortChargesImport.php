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
				'pod' => $row[4],
				'destination_country' => $row[5],
				'carrier' => $row[6],
				'supplier' => $row[7],
				'charge_name' => $row[8],
				'calculation_rule' => $row[9],
				'cost' => $row[10],
				'currency' => $row[11],
				'container_type' => $row[12],
				'goods_type' => $row[13],
				'effective_date' => $row[14],
				'expire_date' => $row[15],
				'sell_rate' => $row[16],
				'internal_notes' => $row[17],
				'external_notes' => $row[18],
				'min_weight' => $row[19],
				'max_weight' => $row[20],
			]);
		}
	}
