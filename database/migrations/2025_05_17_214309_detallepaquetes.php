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
        Schema::create('detalle_paquetes', function (Blueprint $table) {
            $table->id();
            $table->string('descripciondetalle');
            $table->string('precioequipo')->nullable();
            $table->string('precioservicio')->nullable();
            $table->string('preciototal');
            $table->unsignedBigInteger('fk_idpaquete');
            $table->unsignedBigInteger('fk_iddestino');
            $table->unsignedBigInteger('fk_idpromociones')->nullable();

            // Foreign key constraints
            $table->foreign('fk_idpaquete')
                ->references('id')->on('paquetes')
                ->onDelete('cascade');
            $table->foreign('fk_iddestino')
                ->references('id')->on('destinos')
                ->onDelete('cascade');
            $table->foreign('fk_idpromociones')
                ->references('id')->on('promociones')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_paquetes');
    }
};