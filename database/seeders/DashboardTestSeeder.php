<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class DashboardTestSeeder extends Seeder
{
    public function run(): void
    {
        // Messages
        $now = Carbon::now();

        DB::table('message_contacts')->insert([
            [
                'nom' => 'Alice Dupont',
                'email' => 'alice@example.com',
                'sujet' => 'Demande d’information',
                'message' => 'Bonjour, je souhaite en savoir plus...',
                'statut' => 'non_lu',
                'created_at' => $now->subMinutes(10),
                'updated_at' => $now->subMinutes(10),
            ],
            [
                'nom' => 'Bob Martin',
                'email' => 'bob@example.com',
                'sujet' => 'Proposition',
                'message' => 'Voici une proposition de collaboration.',
                'statut' => 'lu',
                'created_at' => $now->subHours(2),
                'updated_at' => $now->subHours(2),
            ],
            [
                'nom' => 'Camille',
                'email' => 'camille@example.com',
                'sujet' => 'Question technique',
                'message' => 'Une question sur le service X.',
                'statut' => 'traite',
                'created_at' => $now->subDays(1),
                'updated_at' => $now->subDays(1),
            ],
        ]);

        // Devis (best-effort: some existing schemas may differ; ignore failures)
        try {
            DB::table('devis')->insert([
                [
                    'nom' => 'Entreprise A',
                    'service_id' => null,
                    'statut' => 'recu',
                    'created_at' => Carbon::now()->subDays(3),
                    'updated_at' => Carbon::now()->subDays(3),
                ],
                [
                    'nom' => 'SARL B',
                    'service_id' => null,
                    'statut' => 'en_cours_etude',
                    'created_at' => Carbon::now()->subDays(10),
                    'updated_at' => Carbon::now()->subDays(10),
                ],
            ]);
        } catch (\Throwable $e) {
            // Ignore seeding failures for devis to keep the seeder idempotent across unknown schemas.
        }

        // Réalisations (best-effort; ignore failures if schema differs)
        try {
            DB::table('realisations')->insert([
                [
                    'titre' => 'Projet Alpha',
                    'lieu' => 'Abidjan',
                    'description' => 'Site web pour client A',
                    'created_at' => Carbon::now()->subDays(5),
                    'updated_at' => Carbon::now()->subDays(5),
                ],
                [
                    'titre' => 'Projet Beta',
                    'lieu' => 'Yamoussoukro',
                    'description' => 'Application mobile',
                    'created_at' => Carbon::now()->subDays(8),
                    'updated_at' => Carbon::now()->subDays(8),
                ],
            ]);
        } catch (\Throwable $e) {
            // ignore
        }
    }
}
