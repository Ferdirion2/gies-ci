<?php

use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    public function up(): void
    {
        $permission = Permission::firstOrCreate(['name' => 'gerer clients', 'guard_name' => 'web']);
        Role::where('name', 'administrateur')->first()?->givePermissionTo($permission);
    }

    public function down(): void
    {
        Permission::where('name', 'gerer clients')->where('guard_name', 'web')->delete();
    }
};