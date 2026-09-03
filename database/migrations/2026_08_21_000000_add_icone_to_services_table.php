<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->string('icone')->nullable()->after('image');
        });

        $icons = [
            'heroicon-o-home-modern',
            'heroicon-o-building-office-2',
            'heroicon-o-wrench-screwdriver',
            'heroicon-o-clipboard-document-check',
        ];

        DB::table('services')
            ->orderBy('ordre')
            ->orderBy('id')
            ->get(['id'])
            ->values()
            ->each(function (object $service, int $index) use ($icons): void {
                DB::table('services')
                    ->where('id', $service->id)
                    ->update(['icone' => $icons[$index] ?? 'heroicon-o-sun']);
            });
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn('icone');
        });
    }
};