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
        Schema::create('servicios', function (Blueprint $table) {
            $table->id();
            $table->string('cantidadservicio');
            $table->unsignedBigInteger('fk_iddetalle_servicios')->nullable();
            $table->unsignedBigInteger('fk_idempresa')->nullable();
            
            // Foreign key constraints
            $table->foreign('fk_iddetalle_servicios')
                ->references('id')->on('detalle_servicios')
                ->onDelete('set null');
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
        Schema::dropIfExists('servicios');
    }
};