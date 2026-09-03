<?php

namespace Tests\Feature;

use App\Mail\ClientPasswordResetCode;
use App\Mail\NouveauCompteClient;
use App\Models\Client;
use App\Models\ClientPasswordResetCode as ResetCode;
use App\Models\Devis;
use App\Models\MessageContact;
use App\Models\Service;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class ClientWorkflowTest extends TestCase
{
    use RefreshDatabase;

    public function test_connected_client_creates_a_devis_on_existing_account(): void
    {
        $client = Client::create(['nom' => 'Client', 'email' => 'client@test.local', 'password' => Hash::make('password')]);
        $this->actingAs($client, 'client');

        $response = $this->post(route('site.devis.store'), $this->devisData($client->email));

        $response->assertRedirect(route('site.devis'));
        $this->assertDatabaseHas('devis', ['client_id' => $client->id, 'email' => $client->email]);
        $this->assertSame(1, Client::where('email', $client->email)->count());
    }

    public function test_existing_account_visitor_creates_devis_then_is_sent_to_login(): void
    {
        $client = Client::create(['nom' => 'Client', 'email' => 'client@test.local', 'password' => Hash::make('password')]);

        $response = $this->post(route('site.devis.store'), $this->devisData($client->email));

        $response->assertRedirect(route('client.login'));
        $this->assertDatabaseHas('devis', ['client_id' => $client->id, 'email' => $client->email]);
    }

    public function test_contact_is_associated_with_authenticated_client(): void
    {
        $client = Client::create(['nom' => 'Client', 'email' => 'client@test.local', 'password' => Hash::make('password')]);
        $this->actingAs($client, 'client');

        $this->post(route('site.contact.store'), [
            'nom' => 'Autre nom', 'email' => 'autre@test.local', 'sujet' => 'Sujet',
            'message' => 'Message', 'consentement' => '1',
        ]);

        $this->assertDatabaseHas('message_contacts', ['client_id' => $client->id, 'email' => $client->email]);
    }

    public function test_client_can_reset_password_with_email_code(): void
    {
        Mail::fake();
        $client = Client::create(['nom' => 'Client', 'email' => 'client@test.local', 'password' => Hash::make('old-password')]);

        $this->post(route('client.password.send-code'), ['email' => $client->email]);
        $code = null;
        Mail::assertSent(ClientPasswordResetCode::class, function (ClientPasswordResetCode $mail) use ($client) {
            $reset = ResetCode::where('email', $client->email)->firstOrFail();
            return true;
        });

        $reset = ResetCode::where('email', $client->email)->firstOrFail();
        Mail::assertSent(ClientPasswordResetCode::class, function (ClientPasswordResetCode $mail) use (&$code) {
            $code = $mail->code;
            return true;
        });
        $this->withSession(['client_password_reset_id' => $reset->id])
            ->post(route('client.password.verify-code'), ['code' => $code])
            ->assertRedirect(route('client.password.reset'));
        $this->withSession(['client_password_reset_id' => $reset->id])
            ->post(route('client.password.reset.update'), ['password' => 'new-password', 'password_confirmation' => 'new-password'])
            ->assertRedirect(route('client.login'));
        $this->assertTrue(Hash::check('new-password', $client->fresh()->password));
    }

    private function devisData(string $email): array
    {
        $service = Service::create([
            'titre' => 'Test service', 'slug' => 'test-service-'.uniqid(),
            'description_courte' => 'Description', 'description_longue' => 'Description longue',
        ]);

        return [
            'nom' => 'Client', 'email' => $email, 'telephone' => '0102030405',
            'service_id' => $service->id, 'type_bien' => 'maison', 'message' => 'Demande',
            'consentement' => '1',
        ];
    }
}