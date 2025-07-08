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
        Schema::table('empresas', function (Blueprint $table) {
            $table->string('nombrebanco')->nullable();
            $table->string('numero_cuenta')->nullable();
            $table->string('numero_cci')->nullable();
            $table->string('qr_yape')->nullable(); // imagen del qr
            $table->string('qr_plin')->nullable(); // imagen del qr
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       Schema::table('empresas', function (Blueprint $table) {
            $table->dropColumn([
                'banco',
                'numero_cuenta',
                'numero_cci',
                'qr_yape',
                'qr_plin'
            ]);
        });
    }
};