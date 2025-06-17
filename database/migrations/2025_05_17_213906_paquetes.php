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
        Schema::create('paquetes', function (Blueprint $table) {
            $table->id();
            $table->decimal('preciopaquete', 10, 2);
            $table->string('nombrepaquete');
            $table->integer('cantidadpaquete');
            $table->text('descripcion')->nullable();
            $table->string('imagen_principal')->nullable();
            $table->enum('estado', ['activo', 'inactivo'])->default('activo');
            $table->unsignedBigInteger('fk_idempresa')->nullable();

            // Foreign key constraints
            $table->foreign('fk_idempresa')
                ->references('id')->on('empresas')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paquetes');
    }
};