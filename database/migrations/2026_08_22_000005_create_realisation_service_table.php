<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('realisation_service', function (Blueprint $table) {
            $table->foreignId('realisation_id')->constrained()->cascadeOnDelete();
            $table->foreignId('service_id')->constrained()->cascadeOnDelete();
            $table->primary(['realisation_id', 'service_id']);
        });

        DB::table('realisations')->select(['id', 'service_id'])->orderBy('id')->each(function (object $realisation): void {
            DB::table('realisation_service')->insertOrIgnore([
                'realisation_id' => $realisation->id,
                'service_id' => $realisation->service_id,
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('realisation_service');
    }
};