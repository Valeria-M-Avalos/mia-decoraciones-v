<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('galeria_imagenes', function (Blueprint $table) {
            // El código de incrustación de Instagram puede ser largo
            $table->text('embed_code_instagram')->nullable()->after('descripcion'); 
        });
    }

    public function down(): void
    {
        Schema::table('galeria_imagenes', function (Blueprint $table) {
            $table->dropColumn('embed_code_instagram');
        });
    }
};