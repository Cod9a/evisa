@extends('back.layouts.dash')

@section('title', 'Tableau de bord')

@section('pageTitle', 'Tableau de bord')

@section('content')
	<div class="row">
		<div class="col-lg-3">
			<a class="dossierCount all" href="{{ route('dossiers.index') }}">
				<p class="title">Dossiers total</p>
				<p class="count">{{ getDossierCount() }}</p>
			</a>
		</div>
		<div class="col-lg-3">
			<a class="dossierCount enCours" href="{{ route('dossiers.index', 10) }}">
				<p class="title">Dossiers en cours</p>
				<p class="count">{{ getDossierStateCount(10) }}</p>
			</a>
		</div>
		<div class="col-lg-3">
			<a class="dossierCount approved" href="{{ route('dossiers.index', 20) }}">
				<p class="title">Dossiers approuvés</p>
				<p class="count">{{ getDossierStateCount(20) }}</p>
			</a>
		</div>
		<div class="col-lg-3">
			<a class="dossierCount controled" href="{{ route('dossiers.index', 30) }}">
				<p class="title">Dossiers contrôlés</p>
				<p class="count">{{ getDossierStateCount(30) }}</p>
			</a>
		</div>
		<div class="col-lg-3">
			<a class="dossierCount finalised" href="{{ route('dossiers.index', 40) }}">
				<p class="title">Dossiers finalisés</p>
				<p class="count">{{ getDossierStateCount(40) }}</p>
			</a>
		</div>
		<div class="col-lg-3">
			<a class="dossierCount rejected" href="{{ route('dossiers.index', 70) }}">
				<p class="title">Dossiers rejetés</p>
				<p class="count">{{ getDossierStateCount(70) }}</p>
			</a>
		</div>
	</div>
@endsection