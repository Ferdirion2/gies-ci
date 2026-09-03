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
        if (! Schema::hasTable('devis')) {
            Schema::create('devis', function (Blueprint $table) {
                $table->id();
                $table->string('nom');
                $table->foreignId('service_id')->nullable()->constrained('services')->nullOnDelete();
                $table->string('statut')->default('recu');
                $table->text('details')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devis');
    }
};
