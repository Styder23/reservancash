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
        Schema::create('detalle_equipos', function (Blueprint $table) {
            $table->id();
            $table->string('name_equipo');
            $table->string('descripcion_equipo');
            $table->double('precio_equipo');
            $table->string('imagenes_equipo');
            $table->unsignedBigInteger('fk_idcategoria')->nullable();
            $table->unsignedBigInteger('fk_idserie')->nullable();
            $table->unsignedBigInteger('fk_idmarca')->nullable();
            $table->unsignedBigInteger('fk_idmodelo')->nullable();
            $table->unsignedBigInteger('fk_idtipoequipo')->nullable();

            // Foreign key constraints
            $table->foreign('fk_idcategoria')
                ->references('id')->on('categorias')
                ->onDelete('set null');
            $table->foreign('fk_idserie')
                ->references('id')->on('serie_equipos')
                ->onDelete('set null');
            $table->foreign('fk_idmarca')
                ->references('id')->on('marcas')
                ->onDelete('set null');
            $table->foreign('fk_idmodelo')
                ->references('id')->on('modelos')
                ->onDelete('set null');
            $table->foreign('fk_idtipoequipo')
                ->references('id')->on('tipoequipos')
                ->onDelete('set null');
        });
    }

        /**
         * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_equipos');
    }
};