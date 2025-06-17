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
        Schema::create('paquete_servicio', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fk_idpaquete')->nullable();
            $table->unsignedBigInteger('fk_idservicio')->nullable();
            
            // Foreign key constraints
            $table->foreign('fk_idpaquete')
                ->references('id')->on('paquetes')
                ->onDelete('set null');
            
            $table->foreign('fk_idservicio')
                ->references('id')->on('servicios')
                ->onDelete('set null');  
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paquete_servicio');
    }
};