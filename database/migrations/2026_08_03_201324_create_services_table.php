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
      Schema::create('services', function (Blueprint $table) {
        $table->id();
        $table->string('titre');
        $table->string('slug')->unique();
        $table->text('description_courte');
        $table->text('description_longue')->nullable();
        $table->text('points_cles')->nullable();
        $table->string('image')->nullable();
        $table->boolean('est_epingle')->default(false);
        $table->integer('ordre')->default(0);
        $table->timestamps();
      });
     }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
