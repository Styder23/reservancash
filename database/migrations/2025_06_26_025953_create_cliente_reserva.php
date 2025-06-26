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
        Schema::create('cliente_reserva', function (Blueprint $table) {
            $table->id();
            $table->date('fechareserva');
            $table->enum('estado', ['pendiente', 'contactado', 'en negociacion', 'confirmado', 'cancelado'])->default('pendiente');
            $table->boolean('confirmado_por_empresa')->default(false);
            $table->text('notas')->nullable(); // para comentarios como "acordaron 150 por WhatsApp"
            $table->unsignedBigInteger('fk_idpaquetecliente')->nullable();
            $table->unsignedBigInteger('fk_idusers')->nullable();

            // Foreign key constraints
            $table->foreign('fk_idpaquetecliente')
                ->references('id')->on('cliente_paquete')
                ->onDelete('set null');

            $table->foreign('fk_idusers')
                ->references('id')->on('users')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cliente_reserva');
    }
};