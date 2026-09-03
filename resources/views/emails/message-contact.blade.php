<p>Vous avez reçu un nouveau message de contact depuis le site :</p>

<ul>
    <li><strong>Nom :</strong> {{ $data['nom'] ?? '—' }}</li>
    <li><strong>Email :</strong> {{ $data['email'] ?? '—' }}</li>
    <li><strong>Sujet :</strong> {{ $data['sujet'] ?? '—' }}</li>
</ul>

<hr>

<p>{{ nl2br(e($data['message'] ?? '')) }}</p>

<hr>

<p>Répondre à ce message : utilisez la fonction "Répondre" de votre client mail. La réponse sera envoyée vers l'adresse du visiteur.</p>
