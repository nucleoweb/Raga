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
			Schema::create('margins', function (Blueprint $table) {
				$table->id();
                $table->string('product_type', 100)->nullable();
                $table->string('service_type', 100)->nullable();
                $table->string('country_name', 100)->nullable();
                $table->string('port_cfs_airport_name', 150)->nullable();
                $table->string('supplier', 150)->nullable();
                $table->decimal('agent_fee', 10, 2)->nullable();
                $table->decimal('handling_fee', 10, 2)->nullable();
                $table->decimal('documentation_fee', 10, 2)->nullable();
                $table->float('total_margin', 8, 2)->nullable();
                $table->date('effective_date')->nullable();
                $table->date('expire_date')->nullable();
                $table->text('internal_notes')->nullable();
                $table->text('external_notes')->nullable();
				$table->timestamps();
			});
		}

		public function down()
		{
			Schema::dropIfExists('margins');
		}

	};
