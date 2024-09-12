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
				$table->string('product_type', 100)->nullable();
				$table->string('service_type', 100)->nullable();
				$table->string('country_name', 100)->nullable();
				$table->string('port_cfs_airport_name', 150)->nullable();
				$table->string('trucker', 100)->nullable();
				$table->string('allowed_carriers', 150)->nullable();
				$table->string('supplier', 150)->nullable();
				$table->string('supplier_charge_name', 150);
				$table->decimal('cost', 10, 2)->nullable();
				$table->decimal('min_cost', 10, 2)->nullable();
				$table->decimal('max_cost', 10, 2)->nullable();
                $table->string('unlocation_id', 50)->nullable();
                $table->string('goodstype', 100)->nullable();
                $table->date('effective_date')->nullable();
                $table->date('expire_date')->nullable();
                $table->string('sell_rate')->nullable();
                $table->text('internal_notes')->nullable();
                $table->text('external_notes')->nullable();
                $table->text('charge_type')->nullable();
                $table->string('min_weight')->nullable();
                $table->string('max_weight')->nullable();
                $table->decimal('min_size', 10, 2)->nullable();
                $table->decimal('max_size', 10, 2)->nullable();
				$table->timestamps();
			});
		}

		public function down()
		{
			Schema::dropIfExists('land_charges');
		}

	};
