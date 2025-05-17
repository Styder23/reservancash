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
        Schema::create('destinos', function (Blueprint $table) {
            $table->id();
            $table->string('namedestino');
            $table->string('descripciondestino');
            $table->string('imagenes');
            $table->string('ubicaciondestino');
            $table->unsignedBigInteger('fk_iddistrito')->nullable();
            $table->unsignedBigInteger('fk_idtipodestino')->nullable();

            // Foreign key constraints
            $table->foreign('fk_iddistrito')
                ->references('id')->on('distritos')
                ->onDelete('set null');
                
            $table->foreign('fk_idtipodestino')
                ->references('id')->on('tipo_destinos')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destinos');
    }
};