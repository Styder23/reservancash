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
        Schema::table('destinos', function (Blueprint $table) {
            
            $table->unsignedBigInteger('fk_idempresa')->nullable()->after('fk_idtipodestino');
            
            //foring keys
            $table->foreign('fk_idempresa')
                    ->references('id')->on('empresas')
                    ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('destinos', function (Blueprint $table) {
            $table->dropForeign(['fk_idempresa']);
            $table->dropColumn('fk_idempresa');
        });
    }
};