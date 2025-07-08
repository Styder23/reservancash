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
        Schema::create('promosiones_usadas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fk_iduser')->nullable();
            $table->unsignedBigInteger('fk_idpromocion')->nullable();
            $table->unsignedBigInteger('fk_idpaquete')->nullable();
            $table->timestamp('fecha_uso')->useCurrent();

            //foring keys
            $table->foreign('fk_idpaquete')
                    ->references('id')->on('paquetes')
                    ->onDelete('set null');
            $table->foreign('fk_idpromocion')
                    ->references('id')->on('promociones')
                    ->onDelete('set null');
            $table->foreign('fk_iduser')
                    ->references('id')->on('users')
                    ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promosiones_usadas');
    }
};