<?php
	
	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Support\Facades\Schema;
	
	return new class extends Migration {
		/**
		 * Run the migrations.
		 */
		public function up()
		{
			Schema::create('land_charges', function (Blueprint $table) {
				$table->id();
				$table->string('product_type', 100);
				$table->string('service_type', 100);
				$table->string('country_name', 100);
				$table->string('port_cfs_airport_name', 150);
				$table->string('trucker', 100);
				$table->string('allowed_carriers', 150)->nullable();
				$table->string('supplier', 150);
				$table->string('inland_service_reference_contract', 150)->nullable();
				$table->string('supplier_charge_name', 150);
				$table->string('internal_charge_name', 150);
				$table->decimal('cost', 10, 2);
				$table->decimal('min_cost', 10, 2)->nullable();
				$table->decimal('max_cost', 10, 2)->nullable();
				$table->string('currency', 10);
				$table->decimal('distance_range_from', 10, 2)->nullable();
				$table->decimal('distance_range_to', 10, 2)->nullable();
				$table->decimal('range_from', 10, 2)->nullable();
				$table->decimal('range_to', 10, 2)->nullable();
				$table->string('zip_code', 10)->nullable();
				$table->string('unlocation_id', 50)->nullable();
				$table->decimal('wm_factor', 10, 2)->nullable();
				$table->string('goodstype', 100)->nullable();
				$table->string('rate_applicability', 100)->nullable();
				$table->date('publish_date');
				$table->date('effective_date');
				$table->date('expire_date')->nullable();
				$table->decimal('sell_rate', 10, 2)->nullable();
				$table->text('internal_notes')->nullable();
				$table->text('external_notes')->nullable();
				$table->text('pricing_notes')->nullable();
				$table->timestamps();
			});
		}
		
		public function down()
		{
			Schema::dropIfExists('land_charges');
		}

	};
