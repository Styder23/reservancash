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
        Schema::table('reservas', function (Blueprint $table) {
            $table->text('motivo_cliente')->nullable()->after('notas');
            $table->timestamp('fecha_solicitud_cancelacion')->nullable()->after('motivo_cliente');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reservas', function (Blueprint $table) {
            $table->dropColumn([
                'motivo_cliente',
                'fecha_solicitud_cancelacion'
            ]);
        });
    }
};