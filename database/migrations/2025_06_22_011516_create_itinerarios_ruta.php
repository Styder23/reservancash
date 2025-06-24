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
        Schema::create('itinerarios_ruta', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fk_iditinerario')->nullable();
            $table->unsignedBigInteger('fk_idruta')->nullable();
            $table->timestamps();

            //foring key
            $table->foreign('fk_iditinerario')
                ->references('id')->on('itinerarios')
                ->onDelete('set null');
            $table->foreign('fk_idruta')
                ->references('id')->on('rutas')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('itinerarios_ruta');
    }
};