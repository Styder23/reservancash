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
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('estado_usu')->default(1);
            $table->unsignedBigInteger('fk_idpersona')->nullable();
            $table->unsignedBigInteger('fk_idtipousu')->nullable();
            $table->integer('intentos_fallidos')->default(0);
            $table->timestamp('bloqueado_hasta')->nullable();
            $table->timestamp('ultimo_acceso')->nullable();

            $table->foreign('fk_idpersona')
                ->references('id')->on('personas')
                ->onDelete('set null');

            $table->foreign('fk_idtipousu')
                ->references('id')->on('tipo_usuarios')
                ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('estado_usu');
            $table->dropForeign(['fk_idpersona']);
            $table->dropColumn('fk_idpersona');
            $table->dropForeign(['fk_idtipousu']);
            $table->dropColumn('fk_idtipousu');
            
        });
    }
};