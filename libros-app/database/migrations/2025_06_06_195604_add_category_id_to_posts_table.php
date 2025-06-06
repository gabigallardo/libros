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
        Schema::table('posts', function (Blueprint $table) {
            // Añade la columna para la clave foránea
            $table->foreignId('category_id')
                ->nullable() // Permite que un post no tenga categoría
                ->after('id') // Coloca la columna después de la columna 'id'
                ->constrained('categories') // Define la restricción de clave foránea
                ->onDelete('set null'); // Si se borra una categoría, el post no se borra, solo se pone null
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            //
        });
    }
};
