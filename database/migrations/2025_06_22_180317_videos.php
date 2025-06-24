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
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('url'); 
            $table->string('tipo')->nullable(); //principal o segundaria
            $table->morphs('videoable'); // Esto crea imageable_id (entero) y imageable_type (string)
            $table->timestamps(); // mantenemos los timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};