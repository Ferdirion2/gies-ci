<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('services')
            ->where('icone', 'heroicon-o-ruler')
            ->update(['icone' => 'heroicon-o-beaker']);
    }

    public function down(): void
    {
    }
};