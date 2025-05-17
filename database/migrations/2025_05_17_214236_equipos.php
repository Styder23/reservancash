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
        Schema::create('equipos', function (Blueprint $table) {
            $table->id();
            $table->integer('cantidadequipo');
            $table->unsignedBigInteger('fk_iddetalle_equipo')->nullable();

            // Foreign key constraints
            $table->foreign('fk_iddetalle_equipo')
                ->references('id')->on('detalle_equipos')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipos');
    }
};