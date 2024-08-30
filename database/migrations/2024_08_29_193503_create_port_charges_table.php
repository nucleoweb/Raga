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
			$table->string('via', 100)->nullable();
			$table->string('pod', 100)->nullable();
			$table->string('dest_country', 100)->nullable();
			$table->string('carrier', 100)->nullable();
			$table->string('supplier', 150)->nullable();
			$table->string('supplier_charge_name', 150)->nullable();
			$table->string('internal_charge_name', 150)->nullable();
			$table->string('calculation_rule', 100)->nullable();
			$table->decimal('cost', 10, 2)->nullable();
			$table->string('currency', 10)->nullable();
			$table->string('goodstype', 100)->nullable();
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
		Schema::dropIfExists('port_charges');
	}
};
