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
        Schema::create('detalle_servicios', function (Blueprint $table) {
            $table->id();
            $table->string('nombreservicio');
            $table->string('descripcionservicio');
            $table->string('imageneservicio');
            $table->double('precioservicio');
            $table->unsignedBigInteger('fk_idtiposervicio')->nullable();

            // Foreign key constraints
            $table->foreign('fk_idtiposervicio')
                ->references('id')->on('tipo_servicios')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_servicios');
    }
};