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
        Schema::create('paquete_promocion', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fk_idpaquete')->nullable();
            $table->unsignedBigInteger('fk_idpromocion')->nullable();
            $table->integer('cantidad_disponible'); // cuántas veces puede usarse esta promo para el paquete
            $table->integer('cantidad_usada')->default(0);
            $table->timestamps();

            //foring keys
            $table->foreign('fk_idpaquete')
                    ->references('id')->on('paquetes')
                    ->onDelete('set null');
            $table->foreign('fk_idpromocion')
                    ->references('id')->on('promociones')
                    ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paquete_promocion');
    }
};