<?php

	namespace App\Imports;

	use App\Models\Margins;
	use Maatwebsite\Excel\Concerns\ToModel;

	class MarginsImport implements ToModel
	{
		/**
		 * @param array $row
		 *
		 * @return \Illuminate\Database\Eloquent\Model|null
		 */
		public function model(array $row) {
			return new Margins([
                'product_type' => $row[0],
                'service_type' => $row[1],
                'country_name' => $row[2],
                'port_cfs_airport_name' => $row[3],
                'supplier' => $row[4],
                'agent_fee' => $this->transformDecimal($row[5]),
                'handling_fee' => $this->transformDecimal($row[6]),
                'documentation_fee' => $this->transformDecimal($row[7]),
                'total_margin' => $this->transformDecimal($row[8]),
                'effective_date' => $this->transformDate($row[9]),
                'expire_date' => $this->transformDate($row[10]),
                'internal_notes' => $row[11],
                'external_notes' => $row[12],
			]);
		}

		public function transformDecimal($value) {
			$value = str_replace(',', '.', $value);
			return is_numeric($value) ? (float) $value : null;
		}

        public function transformDate($value) {
            return \Carbon\Carbon::parse($value);
        }
	}
