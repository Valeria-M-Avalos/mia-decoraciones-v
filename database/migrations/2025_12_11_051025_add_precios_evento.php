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
         Schema::table('eventos', function (Blueprint $table) {
        $table->decimal('costo_base', 10, 2)->nullable();
        $table->decimal('costo_por_invitado', 10, 2)->nullable();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         Schema::table('eventos', function (Blueprint $table) {
        $table->dropColumn(['costo_base', 'costo_por_invitado']);
    });
    }
};
