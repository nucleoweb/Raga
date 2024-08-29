<?php
	
	namespace Database\Seeders;
	
	use Illuminate\Database\Console\Seeds\WithoutModelEvents;
	use Illuminate\Database\Seeder;
	use Illuminate\Support\Facades\DB;
	
	class LandChargeSeeder extends Seeder
	{
		/**
		 * Run the database seeds.
		 */
		public function run(): void
		{
			DB::table('land_charges')->insert([
				[
					'product_type' => 'FCL',
					'service_type' => 'EXPORT',
					'country_name' => null,
					'port_cfs_name' => null,
					'supplier' => null,
					'agent_fee' => 50.00,
					'handling_fee' => 30.00,
					'documentation_fee' => 50.00,
					'total_margin' => 0.18,
					'effective_date' => '2024-01-01',
					'expire_date' => '2024-12-31',
					'internal_note' => 'GASTOS ORIGEN',
					'external_note' => null,
					'created_at' => now(),
					'updated_at' => now(),
				],
			]);
		}
	}
