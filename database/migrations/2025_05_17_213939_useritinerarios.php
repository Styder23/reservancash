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
        Schema::create('user_itinerario', function (Blueprint $table) {
            $table->id();
            $table->text('comentario')->nullable();
            $table->date('fecha')->nullable();
            $table->string('foto')->nullable();
            $table->unsignedBigInteger('fk_idusers')->nullable();
            $table->integer('fk_idpaquete')->nullable();

            // Foreign key constraints
            $table->foreign('fk_idusers')
                ->references('id')->on('users')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_itinerario');
    }
};