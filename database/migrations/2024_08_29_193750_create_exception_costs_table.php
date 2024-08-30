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
			Schema::create('exception_costs', function (Blueprint $table) {
				$table->id();
				$table->string('template', 100)->nullable();
				$table->string('uuid')->nullable()->unique();
				$table->string('customer_id')->nullable();
				$table->string('product_type', 100)->nullable();
				$table->string('service_type', 100)->nullable();
				$table->string('country_name', 100)->nullable();
				$table->string('port_cfs_airport_name', 150)->nullable();
				$table->string('trucker', 100)->nullable();
				$table->string('allowed_carriers', 150)->nullable();
				$table->string('supplier', 150)->nullable();
				$table->string('inland_service_reference_contract', 150)->nullable();
				$table->string('supplier_charge_name', 150)->nullable();
				$table->string('internal_charge_name', 150)->nullable();
				$table->decimal('cost', 10, 2)->nullable();
				$table->string('currency', 10)->nullable();
				$table->string('unlocation_id', 50)->nullable();
				$table->decimal('wm_factor', 8, 4)->nullable(); // Weight/Measurement Factor
				$table->string('goodstype', 100)->nullable();
				$table->string('rate_applicability', 100)->nullable();
				$table->date('publish_date')->nullable();
				$table->date('effective_date')->nullable();
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
			Schema::dropIfExists('exception_costs');
		}

	};
