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
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
            $table->date('fechareserva');
            $table->unsignedBigInteger('fk_idpaquete')->nullable();
            $table->unsignedBigInteger('fk_idusers')->nullable();

            // Foreign key constraints
            $table->foreign('fk_idpaquete')
                ->references('id')->on('paquetes')
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
        Schema::dropIfExists('reservas');
    }
};