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
        Schema::create('avis_clients', function (Blueprint $table) {
            $table->id();
            $table->string('nom_client');
            $table->tinyInteger('note')->unsigned();
            $table->text('commentaire')->nullable();
            $table->enum('statut', ['en_attente', 'approuve'])->default('en_attente');
            $table->date('date_avis');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avis_clients');
    }
};
