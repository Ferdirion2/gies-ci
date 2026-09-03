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
    Schema::create('devis', function (Blueprint $table) {
        $table->id();
        $table->string('nom');
        $table->string('email');
        $table->string('telephone')->nullable();
        $table->foreignId('service_id')->nullable()->constrained('services')->onDelete('restrict');
        $table->enum('type_bien', ['maison', 'entreprise', 'collectivite']);
        $table->text('message')->nullable();
        $table->enum('statut', ['recu', 'en_cours_etude', 'chiffre', 'accepte', 'refuse'])->default('recu');
        $table->foreignId('client_id')->nullable()->constrained('clients')->onDelete('set null');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devis');
    }
};
