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
        Schema::table('user_itinerario', function (Blueprint $table) {
            $table->tinyInteger('estrellas')->default(5); // 1 a 5 estrellas
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_itinerario', function (Blueprint $table) {
            $table->dropColumn([
                'estrellas',
            ]);
        });
    }
};