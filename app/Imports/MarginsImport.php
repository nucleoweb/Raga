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
				'type' => $row[0],
				'description' => $row[1],
				'origin_of_expenses' => $this->transformDecimal($row[2]),
			]);
		}
		
		public function transformDecimal($value) {
			$value = str_replace(',', '.', $value);
			return is_numeric($value) ? (float) $value : null;
		}
	}
