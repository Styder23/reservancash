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
        Schema::create('table_canjeos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fk_iduser')->nullable();
            $table->foreignId('fk_idreserva')->nullable(); // si el premio fue canjeado en reserva general
            $table->foreignId('fk_idclientereserva')->nullable(); // o si fue en reserva personalizada
            $table->timestamp('fecha_canjeo');

            //foreing key
            $table->foreign('fk_iduser')
                    ->references('id')->on('users')
                    ->onDelete('set null');
            $table->foreign('fk_idreserva')
                    ->references('id')->on('reservas')
                    ->onDelete('set null');
            $table->foreign('fk_idclientereserva')
                    ->references('id')->on('cliente_reserva')
                    ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_canjeos');
    }
};