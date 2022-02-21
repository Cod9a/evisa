@extends('back.layouts.dash')

@section('title', 'Ajouter un centre de traitement')

@section('pageTitle', 'Ajouter un centre de traitement')

@section('content')
	<div class="row">
		<div class="col-6 grid-margin stretch-card">
	        <div class="card">
	          <div class="card-body">
	            <h4 class="card-title">Ajouter un centre de traitement</h4>
	            <p class="card-description"> &ndash; Un centre de traitement est une ambassade, un consulat</p>
	            <form class="forms-sample">
	              @csrf
	              <div class="form-group">
	                <label for="name">Libellé</label>
	                <input type="text" class="form-control" placeholder="Libellé" name="name" required>
	                @error('title')
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