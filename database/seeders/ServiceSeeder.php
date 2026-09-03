<?php

namespace Database\Seeders;
use App\Models\Service;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    Service::create([
        'titre' => 'Installation résidentielle',
        'slug' => 'installation-residentielle',
        'description_courte' => 'Panneaux solaires conçus pour les maisons individuelles.',
        'description_longue' => 'Nous concevons et installons des systèmes solaires sur mesure pour les maisons individuelles, du dimensionnement initial jusqu\'à la mise en service.',
        'icone' => 'heroicon-o-home-modern',
        'est_epingle' => true,
        'ordre' => 1,
    ]);

    Service::create([
        'titre' => 'Installation professionnelle',
        'slug' => 'installation-professionnelle',
        'description_courte' => 'Solutions solaires pour entreprises et collectivités.',
        'icone' => 'heroicon-o-building-office-2',
        'est_epingle' => true,
        'ordre' => 2,
    ]);

    Service::create([
        'titre' => 'Maintenance',
        'slug' => 'maintenance',
        'description_courte' => 'Entretien régulier et suivi de la performance des installations.',
        'icone' => 'heroicon-o-wrench-screwdriver',
        'est_epingle' => false,
        'ordre' => 3,
    ]);

    Service::create([
        'titre' => 'Audit énergétique',
        'slug' => 'audit-energetique',
        'description_courte' => 'Étude de faisabilité et de rentabilité avant projet.',
        'icone' => 'heroicon-o-clipboard-document-check',
        'est_epingle' => false,
        'ordre' => 4,
    ]);
}
}
