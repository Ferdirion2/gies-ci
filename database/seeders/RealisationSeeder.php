<?php

namespace Database\Seeders;

use App\Models\Realisation;
use App\Models\Service;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RealisationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    $residentiel = Service::where('slug', 'installation-residentielle')->first();
    $professionnel = Service::where('slug', 'installation-professionnelle')->first();

    Realisation::create([
        'titre' => 'Villa Cotonou',
        'slug' => 'villa-cotonou',
        'description_longue' => 'Installation de 6 kWc en toiture pour une villa familiale.',
        'lieu' => 'Cotonou',
        'date_realisation' => '2026-03-15',
        'client' => 'Confidentiel',
        'kwc' => 6.00,
        'type_bien' => 'maison',
        'service_id' => $residentiel->id,
        'est_epingle' => true,
    ]);

    Realisation::create([
        'titre' => 'Entrepôt Sèmè',
        'slug' => 'entrepot-seme',
        'description_longue' => 'Installation de 40 kWc pour un entrepôt logistique.',
        'lieu' => 'Sèmè-Podji',
        'date_realisation' => '2026-05-10',
        'client' => 'Confidentiel',
        'kwc' => 40.00,
        'type_bien' => 'entreprise',
        'service_id' => $professionnel->id,
        'est_epingle' => true,
    ]);

    Realisation::create([
        'titre' => 'École Porto-Novo',
        'slug' => 'ecole-porto-novo',
        'description_longue' => 'Installation de 15 kWc pour un établissement scolaire.',
        'lieu' => 'Porto-Novo',
        'date_realisation' => '2026-06-20',
        'client' => 'Confidentiel',
        'kwc' => 15.00,
        'type_bien' => 'collectivite',
        'service_id' => $professionnel->id,
        'est_epingle' => false,
    ]);
}
}
