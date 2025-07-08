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
        Schema::create('table_premios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fk_iduser')->nullable();
            $table->integer('cantidad_reservas')->default(0); // reservas válidas acumuladas
            $table->integer('premios_disponibles')->default(0); // premios acumulados y no usados
            $table->integer('premios_usados')->default(0);
            $table->timestamps();

            //foreing key
            $table->foreign('fk_iduser')
                    ->references('id')->on('users')
                    ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_premios');
    }
};