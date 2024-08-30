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
				$table->string('type')->nullable();
				$table->text('description')->nullable();
				$table->decimal('origin_of_expenses', 5, 2)->nullable();
				$table->timestamps();
			});
		}
		
		public function down()
		{
			Schema::dropIfExists('margins');
		}

	};
