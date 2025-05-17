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
        Schema::create('promociones', function (Blueprint $table) {
            $table->id();
            $table->string('namepromocion');
            $table->string('descripcion');
            $table->double('descuento');
            $table->date('fechainicio');
            $table->date('fechafin');
            $table->boolean('estado')->default(1);
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
        Schema::dropIfExists('promociones');
    }
};