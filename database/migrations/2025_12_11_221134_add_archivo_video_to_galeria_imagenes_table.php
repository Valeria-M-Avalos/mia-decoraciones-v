<?php

// ... dentro del archivo database/migrations/..._add_archivo_video_to_galeria_imagenes_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('galeria_imagenes', function (Blueprint $table) {
            // Añadimos una nueva columna para la ruta del archivo de video, permitiendo NULL.
            $table->string('archivo_video')->nullable()->after('embed_code_instagram'); // La colocamos después del campo embed
        });
    }

    public function down(): void
    {
        Schema::table('galeria_imagenes', function (Blueprint $table) {
            $table->dropColumn('archivo_video');
        });
    }
};