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
        Schema::create('imagenes_paquete', function (Blueprint $table) {
            $table->id();
            $table->string('ruta_imagen');
            $table->string('descripcion')->nullable();
            $table->unsignedBigInteger('fk_idpaquete')->nullable();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('fk_idpaquete')
                ->references('id')->on('paquetes')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imagenes_paquete');
    }
};