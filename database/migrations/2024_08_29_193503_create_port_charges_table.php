<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up() {
		Schema::create('port_charges', function (Blueprint $table) {
			$table->id();
			$table->string('product_type')->nullable();
			$table->string('service_type')->nullable();
			$table->string('origin_country')->nullable();
			$table->string('pol')->nullable(); 
			$table->string('pod')->nullable();
			$table->string('destination_country')->nullable();
			$table->string('carrier')->nullable();
			$table->string('supplier')->nullable();
			$table->string('charge_name')->nullable();
			$table->string('calculation_rule')->nullable();
			$table->decimal('cost', 10, 2)->nullable();
			$table->string('currency')->nullable();
			$table->string('container_type')->nullable();
			$table->string('goods_type')->nullable();
			$table->date('effective_date')->nullable();
			$table->date('expire_date')->nullable();
			$table->boolean('sell_rate')->nullable();
			$table->text('internal_notes')->nullable();
			$table->text('external_notes')->nullable();
			$table->decimal('min_weight', 10, 2)->nullable();
			$table->decimal('max_weight', 10, 2)->nullable();
			$table->timestamps();
		});
	}
	
	public function down()
	{
		Schema::dropIfExists('port_charges');
	}
};
