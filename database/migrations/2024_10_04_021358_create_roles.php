<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Role::create(['name' => 'Administrador']);
        Role::create(['name' => 'Pricing']);
        Role::create(['name' => 'Operador logístico']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Role::where('name', 'Administrador')->delete();
        Role::where('name', 'Pricing')->delete();
        Role::where('name', 'Operador logístico')->delete();
    }
};
