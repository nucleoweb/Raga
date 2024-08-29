<?php
	
	namespace Database\Seeders;
	
	use Illuminate\Database\Console\Seeds\WithoutModelEvents;
	use Illuminate\Database\Seeder;
	use Illuminate\Support\Facades\DB;
	
	class PortChargeSeeder extends Seeder
	{
		/**
		 * Run the database seeds.
		 */
		public function run(): void
		{
			DB::table('port_charges')->insert([
				[
					'product_type' => 'FCL',
					'service_type' => 'PortDestinationCharges',
					'origin_country' => null,
					'pol' => null,
					'pod' => 'Caldera',
					'destination_country' => 'Costa Rica',
					'carrier' => 'CMa CGM',
					'supplier' => 'T.H.C. - Maritimo - IMPO - LOC. + IVa',
					'charge_name' => 'Per container',
					'calculation_rule' => 'Per container',
					'cost' => 180.00,
					'currency' => 'USD',
					'container_type' => '40HQ',
					'goods_type' => 'FaK',
					'effective_date' => '2023-06-01',
					'expire_date' => '2023-12-31',
					'sell_rate' => true,
					'internal_notes' => 'aplica por equipo.',
					'external_notes' => 'Por contenedor. / Per container.',
					'min_weight' => null,
					'max_weight' => null,
					'created_at' => now(),
					'updated_at' => now(),
				],
			]);
		}
	}
