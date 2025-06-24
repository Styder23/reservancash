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
        Schema::create('paquete_equipo', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fk_idpaquete')->nullable();
            $table->unsignedBigInteger('fk_idequipo')->nullable();

            // Foreign key constraints
            $table->foreign('fk_idpaquete')
                ->references('id')->on('paquetes')
                ->onDelete('set null');
            
            $table->foreign('fk_idequipo')
                ->references('id')->on('equipos')
                ->onDelete('set null'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paquete_equipo');
    }
};