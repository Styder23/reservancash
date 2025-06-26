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
        Schema::create('cliente_paquete', function (Blueprint $table) {
            $table->id();
            $table->decimal('preciototal', 10, 2)->nullable(); // puede recalcularse
            $table->date('fechacreacion')->default(DB::raw('CURRENT_DATE'));
            $table->enum('estado', ['borrador', 'confirmado'])->default('borrador');
            $table->unsignedBigInteger('fk_iduser')->nullable();
            $table->unsignedBigInteger('fk_idpaquete')->nullable();

            //foring key
            $table->foreign('fk_iduser')
                ->references('id')->on('users')
                ->onDelete('set null');
            $table->foreign('fk_idpaquete')
                ->references('id')->on('paquetes')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cliente_paquete');
    }
};