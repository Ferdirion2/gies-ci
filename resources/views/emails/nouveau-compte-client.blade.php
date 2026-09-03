@component('mail::message')

# Bienvenue chez GIES-CI

Bonjour {{ $nom }},

Un compte client a été créé automatiquement pour vous suite à votre demande de devis.

- Email : **{{ $emailClient }}**
- Mot de passe temporaire : **{{ $motDePasse }}**

Nous vous invitons à vous connecter et à changer immédiatement votre mot de passe pour plus de sécurité.

@component('mail::button', ['url' => route('client.login')])
Accéder à l'espace client
@endcomponent

Si vous n'avez pas demandé ce compte, ignorez cet e-mail ou contactez notre support.

Merci,
L'équipe GIES-CI

@endcomponent
