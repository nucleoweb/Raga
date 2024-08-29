<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExceptionCostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
	    DB::table('exception_costs')->insert([
		    [
			    'exception_type' => 'Overweight',
			    'value' => 5000.00,
			    'cost' => 100.00,
			    'service_type' => 'Delivery',
			    'effective_date' => '2024-01-01',
			    'expire_date' => '2024-12-31',
			    'notes' => 'Aplica para cargas superiores a 5000kg',
			    'created_at' => now(),
			    'updated_at' => now(),
		    ],
	    ]);
    }
}
