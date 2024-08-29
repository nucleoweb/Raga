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
				$table->string('product_type')->nullable();
				$table->string('service_type')->nullable();
				$table->decimal('default_margin', 5, 2)->nullable();
				$table->timestamps();
			});
		}
		
		public function down()
		{
			Schema::dropIfExists('margins');
		}

	};
