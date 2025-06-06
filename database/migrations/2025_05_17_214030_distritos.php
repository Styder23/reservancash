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
        Schema::create('distritos', function (Blueprint $table) {
            $table->id();
            $table->string('namedistrito');
            $table->unsignedBigInteger('fk_idprovincia')->nullable();

            // Foreign key constraints
            $table->foreign('fk_idprovincia')
                ->references('id')->on('provincias')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('distritos');
    }
};