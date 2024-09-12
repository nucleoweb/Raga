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
                'product_type' => $row[0] ?? null,
                'service_type' => $row[1] ?? null,
                'origin_country' => $row[2] ?? null,
                'pol' => $row[3] ?? null,
                'pod' => $row[4] ?? null,
                'dest_country' => $row[5] ?? null,
                'carrier' => $row[6] ?? null,
                'supplier_charge_name' => $row[7] ?? null,
                'calculation_rule' => $row[8] ?? null,
                'cost' => $this->transformDecimal($row[9]),
                'currency' => $row[10] ?? null,
                'goodstype' => $row[11] ?? null,
                'effective_date' => $this->transformDate($row[12]),
                'expire_date' => $this->transformDate($row[13]),
                'sell_rate' => $row[14] ?? null,
                'internal_notes' => $row[15] ?? null,
                'external_notes' => $row[16] ?? null,
                'min_weight' => $row[17] ?? null,
                'max_weight' => $row[18] ?? null,
                'min_size' => $this->transformDecimal($row[19]) ?? null,
                'max_size' => $this->transformDecimal($row[20]) ?? null,
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
