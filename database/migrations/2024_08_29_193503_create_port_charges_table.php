<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
	public function up() {
		Schema::create('port_charges', function (Blueprint $table) {
			$table->id();
			$table->string('product_type', 100)->nullable();
			$table->string('service_type', 100)->nullable();
			$table->string('origin_country', 100)->nullable();
            $table->string('pol', 100)->nullable();
            $table->string('pod', 100)->nullable();
			$table->string('dest_country', 100)->nullable();
			$table->string('carrier', 100)->nullable();
			$table->string('supplier_charge_name', 150)->nullable();
            $table->string('calculation_rule', 100)->nullable();
			$table->decimal('cost', 10, 2)->nullable();
			$table->string('currency', 10)->nullable();
			$table->string('goodstype', 100)->nullable();
			$table->date('effective_date')->nullable();
			$table->date('expire_date')->nullable();
			$table->string('sell_rate')->nullable();
			$table->text('internal_notes')->nullable();
			$table->text('external_notes')->nullable();
            $table->string('min_weight')->nullable();
            $table->string('max_weight')->nullable();
            $table->decimal('min_size', 10, 2)->nullable();
            $table->decimal('max_size', 10, 2)->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::dropIfExists('port_charges');
	}
};
