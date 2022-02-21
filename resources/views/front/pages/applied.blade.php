@extends('front.layouts.front')

@section('title', 'Paiement effectué')

@section('content')
	<div id="applied" class="container px-5 page" style="margin-top: 5em">
		<div class="row">
			<div class="col-12">
				<h1>Paiement effectué avec succès</h1>
			</div>
		</div>

		<div class="row applied">
			<div class="col-lg-6 mb-4">
				<p class="bg bg-primary text-white p-3 mt-4">Nous avons reçu avec succès votre paiement. <br> Nous vous avons envoyé en mail les détails de la transaction.</p>
				<a href="{{ route('applyStatus') }}" class="btn btn-dark rounded-pill px-3 mb-2 mb-lg-0">Consulter l'état de la demande</a>
			</div>
		</div>
	</div>
@endsection

@section('customScripts')
	
@endsection