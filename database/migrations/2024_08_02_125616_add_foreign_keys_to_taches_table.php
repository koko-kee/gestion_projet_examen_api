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
        Schema::table('taches', function (Blueprint $table) {
            $table->foreign(['id_projet'], 'fk_taches_projets')->references(['id'])->on('projets')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['id_assigne'], 'fk_taches_users')->references(['id'])->on('users')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('taches', function (Blueprint $table) {
            $table->dropForeign('fk_taches_projets');
            $table->dropForeign('fk_taches_users');
        });
    }
};

