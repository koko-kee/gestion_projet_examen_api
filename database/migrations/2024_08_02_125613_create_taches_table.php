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
        Schema::create('taches', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('titre');
            $table->text('description')->nullable();
            $table->date('date_echeance');
            $table->string('priorite')->nullable()->default('Moyenne');
            $table->string('etat')->nullable()->default('À faire');
            $table->integer('id_projet')->nullable()->index('id_projet');
            $table->integer('id_assigne')->nullable()->index('id_assigne');
            $table->timestamp('date_creation')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taches');
    }
};
