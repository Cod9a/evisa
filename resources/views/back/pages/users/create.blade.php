@extends('back.layouts.dash')

@section('title', 'Ajouter un utilisateur')

@section('pageTitle', 'Ajouter un utilisateur')

@section('content')
    <div class="actions row">
        <div class="actions2 col-lg-12">
            <a class="btn btn-primary" href="{{ route('users.index') }}"><i class="fas fa-list-ul"></i> Liste des utilisateurs</a>
        </div>
    </div>
	<div class="row">
		<div class="col-6 grid-margin stretch-card">
	        <div class="card">
	          <div class="card-body">
	            <h4 class="card-title">Ajouter 
	            	<span class="text-lowercase">
	                  un 
	                  @if($role == 'super-admin')
	                    super administrateur
	                  @elseif($role == 'admin')
	                    administrateur
	                  @elseif($role == 'frontal-agent')
	                    agents frontalier
	                  @else
	                    agent
	                  @endif
                	</span>
	            </h4>
	            <form class="pt-3" method="post" action="{{ route('users.store', $role) }}">
                  @csrf
                  <div class="form-group">
                    <input type="text" placeholder="Entrer le nom" required autofocus name="name" class="form-control form-control-lg @error('name') is-invalid @enderror" value="{{ old('name') }}">
                    @error('name')
                        <p class="text-danger" role="alert">
                            {{ $message }}
                        </p>
                    @enderror
                  </div>

                  <div class="form-group">
                    <input type="text" placeholder="Votre prénom" required name="surname" class="form-control form-control-lg @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}">
                    @error('surname')
                        <p class="text-danger" role="alert">
                            {{ $message }}
                        </p>
                    @enderror
                  </div>

                  <div class="form-group">
                    <input type="email" placeholder="Votre adresse email" required class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
                    @error('email')
                        <p class="text-danger" role="alert">
                            {{ $message }}
                        </p>
                    @enderror
                  </div>
                  <div class="form-group">
                    <select name="sex" required class="form-control form-control-lg @error('email') is-invalid @enderror">
                      <option default hidden>-- Sélectionner le sexe --</option>
                      <option value="F" {{ old('sex') == 'F' ? 'selected' : '' }}>Féminin</option>
                      <option value="M" {{ old('sex') == 'M' ? 'selected' : '' }}>Masculin</option>
                    </select>
                    @error('sex')
                        <p class="text-danger" role="alert">
                            {{ $message }}
                        </p>
                    @enderror
                  </div>
                  <div class="form-group">
                    <select name="country" required class="form-control form-control-lg @error('email') is-invalid @enderror">
                      <option default hidden>-- Sélectionner la nationalité --</option>
                      @foreach(getCountries() as $country)
                        <option value="{{ $country->code }}" {{ old('country') == $country->code ? 'selected' : '' }}>{{ $country->name }}</option>
                      @endforeach
                    </select>
                    @error('country')
                        <p class="text-danger" role="alert">
                            {{ $message }}
                        </p>
                    @enderror
                  </div>
                  @if($role == 'agent' || $role == 'admin')
	                  <div class="form-group">
	                    <select name="center_id" required class="form-control form-control-lg @error('email') is-invalid @enderror">
	                      <option default hidden>-- Sélectionner le centre d'intervention --</option>
	                      @foreach(getCenters() as $center)
	                        <option value="{{ $center->id }}" {{ old('center_id') == $center->id ? 'selected' : '' }}>{{ $center->name }}</option>
	                      @endforeach
	                    </select>
	                    @error('center_id')
	                        <p class="text-danger" role="alert">
	                            {{ $message }}
	                        </p>
	                    @enderror
	                  </div>
	               @endif
             
                  <div class="mt-3">
                  	<a href="{{ route('users.index') }}" class="btn btn-secondary"><i class="far fa-window-close"></i> Annuler</a>
                  	<button type="submit" class="btn btn-primary font-weight-medium"><i class="far fa-paper-plane"></i> Ajouter</button>
                  </div>
                </form>
	          </div>
	        </div>
	      </div>
	  </div>
@endsection