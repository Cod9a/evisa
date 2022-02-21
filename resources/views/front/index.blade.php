@extends('front.layouts.front')

@section('title', 'Accueil')

@section('content')
	{{-- @include('front.partials.header') --}}

	<div class="homeHero" style="background: url({{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/front/assets/img/cameroun_bg.jpg') }})">
		<div class="content">
			<h1>Obtenez votre visa pour le Cameroun en un rien de temps.</h1>
			<p>
				<a href="{{ route('applyForVisa') }}" class="btn btn-primary mt-4 rounded-pill p-3 mb-2 mb-lg-0"><i class="fas fa-paper-plane"></i> Faire une demande de visa</a>
			</p>
		</div>
	</div>
@endsection