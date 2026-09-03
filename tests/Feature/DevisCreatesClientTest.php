<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use App\Mail\NouveauCompteClient;
use App\Models\Client;
use App\Models\Service;

class DevisCreatesClientTest extends TestCase
{
    use RefreshDatabase;

    public function test_devis_submission_creates_client_and_sends_email()
    {
        Mail::fake();

        $service = Service::create([
            'titre' => 'Test Service',
            'slug' => 'test-service',
            'description_courte' => 'Description du service',
        ]);

        $response = $this->post(route('site.devis.store'), [
            'nom' => 'Jean Test',
            'email' => 'jean.test@example.test',
            'telephone' => '0102030405',
            'service_id' => $service->id,
            'type_bien' => 'maison',
            'message' => 'Demande de test',
            'consentement' => '1',
        ]);

        $response->assertRedirect(route('site.devis'));

        $this->assertDatabaseHas('clients', ['email' => 'jean.test@example.test']);
        $this->assertDatabaseHas('devis', ['email' => 'jean.test@example.test']);

        Mail::assertSent(NouveauCompteClient::class, function ($mail) {
            return $mail->hasTo('jean.test@example.test');
        });
    }
}
