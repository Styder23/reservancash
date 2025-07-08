<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('paquetes', function (Blueprint $table) {
            $table->dropColumn('cantidadpaquete'); // elimina cantidadpaquete
            $table->decimal('precio_base', 8, 2)->nullable(); // base hasta X personas
            $table->integer('personas_incluidas')->default(1); // personas sin recargo
            $table->decimal('precio_extra_persona', 8, 2)->nullable(); // por cada persona adicional
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('paquetes', function (Blueprint $table) {
            $table->integer('cantidadpaquete')->nullable();
            $table->dropColumn(['precio_base', 'personas_incluidas', 'precio_extra_persona']);
        });
    }
};