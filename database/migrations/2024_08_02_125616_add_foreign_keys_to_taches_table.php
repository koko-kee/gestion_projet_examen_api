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
            $table->foreign(['id_projet'], 'taches_ibfk_1')->references(['id'])->on('projets')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['id_assigné'], 'taches_ibfk_2')->references(['id'])->on('users')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('taches', function (Blueprint $table) {
            $table->dropForeign('taches_ibfk_1');
            $table->dropForeign('taches_ibfk_2');
        });
    }
};
