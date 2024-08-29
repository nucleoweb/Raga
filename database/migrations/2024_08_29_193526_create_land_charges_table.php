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
				$table->string('product_type')->nullable();
				$table->string('service_type')->nullable();
				$table->string('country_name')->nullable();
				$table->string('port_cfs_name')->nullable(); // CFS: Container Freight Station
				$table->string('supplier')->nullable();
				$table->decimal('agent_fee', 10, 2)->nullable();
				$table->decimal('handling_fee', 10, 2)->nullable();
				$table->decimal('documentation_fee', 10, 2)->nullable();
				$table->decimal('total_margin', 5, 2)->nullable();
				$table->date('effective_date')->nullable();
				$table->date('expire_date')->nullable();
				$table->text('internal_note')->nullable();
				$table->text('external_note')->nullable();
				$table->timestamps();
			});
		}
		
		public function down()
		{
			Schema::dropIfExists('land_charges');
		}

	};
