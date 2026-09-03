<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Client;
use App\Models\Devis;
use Illuminate\Support\Facades\Hash;

class ClientDashboardShowsDevisTest extends TestCase
{
    use RefreshDatabase;

    public function test_dashboard_displays_client_devis()
    {
        $password = 'secret12345';
        $client = Client::create([
            'nom' => 'Client Test',
            'email' => 'client2@test.local',
            'password' => Hash::make($password),
        ]);

        Devis::create([
            'nom' => 'Client Test',
            'email' => $client->email,
            'type_bien' => 'maison',
            'statut' => 'recu',
            'client_id' => $client->id,
        ]);

        $this->actingAs($client, 'client');

        $response = $this->get(route('client.dashboard'));

        $response->assertStatus(200);
        $response->assertSee('Reçu');
    }
}
