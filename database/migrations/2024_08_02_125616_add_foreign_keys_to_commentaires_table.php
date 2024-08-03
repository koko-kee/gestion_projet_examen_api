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
        Schema::table('commentaires', function (Blueprint $table) {
            $table->foreign(['id_tache'], 'commentaires_ibfk_1')->references(['id'])->on('taches')->onUpdate('restrict')->onDelete('restrict');
            $table->foreign(['id_utilisateur'], 'commentaires_ibfk_2')->references(['id'])->on('users')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('commentaires', function (Blueprint $table) {
            $table->dropForeign('commentaires_ibfk_1');
            $table->dropForeign('commentaires_ibfk_2');
        });
    }
};
