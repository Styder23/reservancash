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
        Schema::table('reservas', function (Blueprint $table) {
            $table->date('fecha_viaje')->nullable()->after('fechareserva');
            $table->integer('cantidad_personas')->default(1)->after('fk_idusers');
            $table->enum('estado', ['pendiente', 'confirmada', 'cancelada', 'completada'])->default('pendiente')->after('cantidad_personas');
            $table->string('metodo_pago')->nullable()->after('estado');
            $table->decimal('total_pago', 10, 2)->nullable()->after('metodo_pago');
            $table->text('notas')->nullable()->after('total_pago');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservas', function (Blueprint $table) {
            $table->dropColumn(['fecha_viaje', 'cantidad_personas', 'estado', 'metodo_pago', 'total_pago', 'notas']);
        });
    }
};