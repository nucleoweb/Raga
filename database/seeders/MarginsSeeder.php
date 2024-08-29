<?php
	
	namespace Database\Seeders;
	
	use Illuminate\Database\Console\Seeds\WithoutModelEvents;
	use Illuminate\Database\Seeder;
	use Illuminate\Support\Facades\DB;
	
	class MarginsSeeder extends Seeder
	{
		/**
		 * Run the database seeds.
		 */
		public function run(): void {
			DB::table('margins')->insert([
				[
					'product_type' => 'FCL EXPORTACIONES AGENTES',
					'service_type' => 'Agent Fee - Maritimo - EXPO 0%',
					'default_margin' => 50.00,
					'created_at' => now(),
					'updated_at' => now(),
				],
				[
					'product_type' => 'FCL EXPORTACIONES AGENTES',
					'service_type' => 'Documentacion de Exportación - Marítimo - EXPO - LOC.0%',
					'default_margin' => 50.00,
					'created_at' => now(),
					'updated_at' => now(),
				],
				[
					'product_type' => 'FCL IMPORTACIONES AGENTES',
					'service_type' => 'MANEJO POR CONTENEDOR',
					'default_margin' => 100.00,
					'created_at' => now(),
					'updated_at' => now(),
				],
				[
					'product_type' => 'FCL IMPORTACIONES AGENTES',
					'service_type' => 'TICA FEE  POR HBL',
					'default_margin' => 35.00,
					'created_at' => now(),
					'updated_at' => now(),
				],
				[
					'product_type' => 'FCL EXPORTACIONES CLIENTES',
					'service_type' => 'MARGEN TOTAL',
					'default_margin' => 0.18,
					'created_at' => now(),
					'updated_at' => now(),
				],
				[
					'product_type' => 'FCL IMPORTACIONES CLIENTES',
					'service_type' => 'MARGEN TOTAL',
					'default_margin' => 0.18,
					'created_at' => now(),
					'updated_at' => now(),
				],
			]);
		}
	}
