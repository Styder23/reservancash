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
        Schema::create('table_respuestacomentario', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fk_idcomentario');
            $table->unsignedBigInteger('fk_idusers');
            $table->text('respuesta');
            $table->timestamp('fecha_respuesta')->useCurrent();

            //foreing keys
            $table->foreign('fk_idcomentario')->references('id')->on('user_itinerario')->onDelete('cascade');
            $table->foreign('fk_idusers')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_respuestacomentario');
    }
};