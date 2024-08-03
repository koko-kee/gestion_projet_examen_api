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
        Schema::table('pieces_jointes', function (Blueprint $table) {
            $table->foreign(['id_tache'], 'pieces_jointes_ibfk_1')->references(['id'])->on('taches')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pieces_jointes', function (Blueprint $table) {
            $table->dropForeign('pieces_jointes_ibfk_1');
        });
    }
};
