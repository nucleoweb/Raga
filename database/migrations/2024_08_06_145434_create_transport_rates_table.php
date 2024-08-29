<?php
	
	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Support\Facades\Schema;
	
	return new class extends Migration {
		/**
		 * Run the migrations.
		 */
		public function up(): void
		{
			Schema::create('transport_rates', function (Blueprint $table) {
				$table->id();
				$table->string('puerto_origen')->nullable();
				$table->string('ciudad_destino')->nullable();
				$table->string('tipo_de_transporte')->nullable();
				$table->decimal('port_fee', 10, 2)->nullable();
				$table->decimal('transport_fee', 10, 2)->nullable()->nullable();
				$table->decimal('margen_aplicado', 5, 2)->nullable();
				$table->string('id_del_envio')->nullable();
				$table->date('fecha_de_vigencia')->nullable();
				$table->timestamps();
			});
		}
		
		/**
		 * Reverse the migrations.
		 */
		public function down(): void
		{
			Schema::dropIfExists('transport_rates');
		}
	};
