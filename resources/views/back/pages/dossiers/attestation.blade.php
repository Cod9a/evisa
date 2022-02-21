<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Attestation</title>
	</style>
</head>
<body>
	<div class="row header">
		<!-- <img src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/images/cameroun.png') }}" width="120px" height="75px" style="object-fit: contain;" class="mr-4"> -->
		{{ $dossier }}
		<p>
			<span>E-visa Cameroun</span>
			<span>Le site officiel des visas pour le Cameroun</span>
		</p>
	</div>
	<div class="row title">
		<h1>Récépissé de demande de visa</h1>
	</div>
	<p>Le 08/01/2022, la demande suivante a bien été enregistrée par le système E-visa Cameroun.</p>
	<div class="row infos">
		<div>
			<p>Référence de la demande: AAAAAAAAAAAAAAAAA</p>
			<p>Nom: AAAAAAAAAAAAAA</p>
			<p>Prénom: AAAAAAAAAAAAAA</p>
		</div>
		<div style="margin-left: 10em;">
			QR Code
		</div>
	</div>
	<div class="row">
		<h2 style="border-bottom: 2px solid #ccc;">VOTRE LIEU DE RENDEZ-VOUS</h2>
		<p>Veuillez vous rendre au centre AAAAAAAAAAAAAAAAAAAAAAAA</p>
	</div>
</body>
</html>