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
				$table->string('exception_type')->nullable();
				$table->decimal('value', 10, 2)->nullable();
				$table->decimal('cost', 10, 2)->nullable();
				$table->string('service_type')->nullable();
				$table->date('effective_date')->nullable();
				$table->date('expire_date')->nullable()->nullable();
				$table->text('notes')->nullable();
				$table->timestamps();
			});
		}
		
		public function down()
		{
			Schema::dropIfExists('exception_costs');
		}

	};
