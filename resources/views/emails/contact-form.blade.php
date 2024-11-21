<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau message de contact</title>
</head>
<body>
    <h1>Nouveau message de contact</h1>
    <p><strong>Nom :</strong> {{ $contact->nom }}</p>
    <p><strong>Email :</strong> {{ $contact->email }}</p>
    <p><strong>Sujet :</strong> {{ $contact->sujet }}</p>
    <h2>Message :</h2>
    <p>{{ $contact->message }}</p>
    <p>
        <a href="{{ route('dashboard') }}">Voir dans le tableau de bord</a>
    </p>
    <p>Merci,<br>{{ config('app.name') }}</p>
</body>
</html>
