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
        Schema::table('servicios', function (Blueprint $table) {
            $table->string('icono')->nullable()->after('nombre'); // Emoji o clase de icono
            $table->string('imagen')->nullable()->after('icono'); // Ruta de la imagen
            $table->string('categoria')->default('general')->after('descripcion'); // Categoría del servicio
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('servicios', function (Blueprint $table) {
            $table->dropColumn(['icono', 'imagen', 'categoria']);
        });
    }
};