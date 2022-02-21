@component('mail::message')

# Votre dossier a bien été reçu.

Bonjour {{ getUserName($dossier->user_id) }}. <br>
Votre dossier a bien été reçu. <br>
Il est pris en charge par le centre de traitement <b>{{ getCenter($dossier->center_id) }}</b> et est <b>en attente de paiement.<b> <br>
Cliquez sur le lien ci-dessous pour régler cela (lien valable pendant 30 minutes). <br>
<a href="{{ route('payment', ['dossier_id' => $dossier->id, 'token' => $dossier->token]) }}" class="btn btn-primary mt-4">{{ route('payment', ['dossier_id' => $dossier->id, 'token' => $dossier->token]) }}</a>

@endcomponent