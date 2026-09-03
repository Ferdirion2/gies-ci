<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;

class ClientAuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_client_can_login_with_credentials()
    {
        $password = 'secret12345';
        $client = Client::create([
            'nom' => 'Client Test',
            'email' => 'client@test.local',
            'password' => Hash::make($password),
        ]);

        $response = $this->post(route('client.login'), [
            'email' => $client->email,
            'password' => $password,
        ]);

        $response->assertRedirect(route('client.dashboard'));
        $this->assertAuthenticatedAs($client, 'client');
    }
}
