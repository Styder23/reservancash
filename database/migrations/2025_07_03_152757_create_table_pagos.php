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
        Schema::create('table_pagos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('metodo')->nullable(); // 'yape', 'plin'
            $table->string('comprobante_pago');   // ruta de imagen
            $table->enum('estado', ['pendiente', 'aprobado', 'rechazado'])->default('pendiente');
            $table->timestamp('fecha_pago')->nullable(); // puede ir la fecha que subió el comprobante
            $table->unsignedBigInteger('fk_idreserva')->nullable();

            // foreing key
            $table->foreign('fk_idreserva')
                    ->references('id')->on('reservas')
                    ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_pagos');
    }
};