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
        Schema::create('cliente_destinos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fk_idclientepaquete')->nullable();;
            $table->unsignedBigInteger('fk_iddestino')->nullable();;

            //foring key
            $table->foreign('fk_idclientepaquete')
                ->references('id')->on('cliente_paquete')
                ->onDelete('set null');
            $table->foreign('fk_iddestino')
                ->references('id')->on('destinos')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cliente_destinos');
    }
};