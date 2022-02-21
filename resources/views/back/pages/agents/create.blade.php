@extends('back.layouts.dash')

@section('title', 'Ajouter un centre de traitement')

@section('pageTitle', 'Ajouter un centre de traitement')

@section('content')
	<div class="row">
		<div class="col-6 grid-margin stretch-card">
	        <div class="card">
	          <div class="card-body">
	            <h4 class="card-title">Ajouter un agent</h4>
	            <form class="forms-sample">
	              @csrf
	              <div class="form-group">
	                <label for="name">Nom</label>
	                <input type="text" class="form-control" placeholder="Entrer le nom" name="name" required>
	                @error('name')
	                  <p class="text-sm text-red-600">{{ $message }}</p>
	              	@enderror
	              </div>
	              <div class="form-group">
	                <label for="name">Prénom(s)</label>
	                <input type="text" class="form-control" placeholder="Entrer le prénom(s)" name="surname" required>
	                @error('surname')
	                  <p class="text-sm text-red-600">{{ $message }}</p>
	              	@enderror
	              </div>
	              <div class="form-group">
	                <label for="email">Email</label>
	                <input type="email" class="form-control" placeholder="Adresse email" name="email" required>
	                @error('email')
	                  <p class="text-sm text-red-600">{{ $message }}</p>
	              	@enderror
	              </div>
	              <div class="form-group">
	                <label for="name">Nom</label>
	                <input type="text" class="form-control" placeholder="Entrer le nom" name="name" required>
	                @error('name')
	                  <p class="text-sm text-red-600">{{ $message }}</p>
	              	@enderror
	              </div>
	              <div class="form-group">
	                <label for="exampleSelectGender">Pays d'origine</label>
	                <select class="form-control" name="sex" required>
                      <option default hidden>-- Sélectionner le pays --</option>
                      <option value="F">Féminin</option>
                      <option value="M">Masculin</option>
                    </select>
                    @error('title')
	                  <p class="text-sm text-red-600">{{ $message }}</p>
	              	@enderror
	              </div>
	              <div class="form-group">
	                <label for="exampleSelectGender">Pays localisé</label>
	                <select class="form-control" name="sex" required>
                      <option default hidden>-- Sélectionner le pays --</option>
                      <option value="F">Féminin</option>
                      <option value="M">Masculin</option>
                    </select>
                    @error('title')
	                  <p class="text-sm text-red-600">{{ $message }}</p>
	              	@enderror
	              </div>
	           
	              <button type="submit" class="btn btn-primary mr-2">Enregistrer</button>
	              <button class="btn btn-light">Annuler</button>
	            </form>
	          </div>
	        </div>
	      </div>
	  </div>
@endsection