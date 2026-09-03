<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'gerer contenu',
            'gerer services',
            'gerer realisations',
            'gerer medias',
            'gerer devis',
            'gerer utilisateurs',
            'gerer clients',
            'gerer parametres',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $admin = Role::firstOrCreate(['name' => 'administrateur']);
        $admin->syncPermissions($permissions);

        $editeur = Role::firstOrCreate(['name' => 'editeur']);
        $editeur->syncPermissions([
            'gerer contenu',
            'gerer services',
            'gerer realisations',
            'gerer medias',
            'gerer devis',
        ]);
    }
}