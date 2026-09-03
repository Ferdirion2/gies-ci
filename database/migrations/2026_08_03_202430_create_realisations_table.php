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
    Schema::create('realisations', function (Blueprint $table) {
        $table->id();
        $table->string('titre');
        $table->string('slug')->unique();
        $table->text('description_longue')->nullable();
        $table->string('lieu')->nullable();
        $table->date('date_realisation')->nullable();
        $table->string('client')->nullable();
        $table->decimal('kwc', 5, 2)->nullable();
        $table->enum('type_bien', ['maison', 'entreprise', 'collectivite']);
        $table->foreignId('service_id')->constrained('services')->onDelete('restrict');
        $table->boolean('est_epingle')->default(false);
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('realisations');
    }
};
