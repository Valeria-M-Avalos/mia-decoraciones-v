<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('galeria_imagenes', function (Blueprint $table) {
            // Agregar columna categoría para organizar imágenes
            $table->string('categoria')->default('general')->after('tipo_evento');
            // Categorías: 'cumpleanos', 'bodas', 'xv_anos', 'bautizos', 'otros', 'general'
        });
    }

    public function down(): void
    {
        Schema::table('galeria_imagenes', function (Blueprint $table) {
            $table->dropColumn('categoria');
        });
    }
};