@component('mail::message')
# Réinitialisation de votre mot de passe

Votre code de vérification est :

## {{ $code }}

Ce code expire dans 10 minutes. Si vous n'êtes pas à l'origine de cette demande, ignorez cet e-mail.

Merci,<br>
L'équipe GIES-CI
@endcomponent