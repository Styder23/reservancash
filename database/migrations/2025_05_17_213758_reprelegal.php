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
        Schema::create('representante_legal', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');
            $table->unsignedBigInteger('fk_idempresa')->nullable();
            $table->unsignedBigInteger('fk_idpersona')->nullable();

            // Foreign key constraints
            $table->foreign('fk_idempresa')
                ->references('id')->on('empresas')
                ->onDelete('set null');
            $table->foreign('fk_idpersona')
                ->references('id')->on('personas')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('representante_legal');
    }
};