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
    Schema::create('page_a_propos', function (Blueprint $table) {
        $table->id();
        $table->text('histoire')->nullable();
        $table->text('mission_valeurs')->nullable();
        $table->text('texte_equipe')->nullable();
        $table->string('photo_equipe')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_a_propos');
    }
};
