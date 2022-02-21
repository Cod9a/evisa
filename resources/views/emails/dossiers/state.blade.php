@component('mail::message')

# Votre dossier a été {{ $stateString }}.

Cliquez sur le bouton ci-dessous pour plus d'informations. <br>

@component('mail::button', ['url' => route('applyStatus')])
	Consulter le statut de la demande
@endcomponent

Cordialement, l'Equipe E-visa Cameroun. <br>

@endcomponent