@extends('back.layouts.dash')

@section('title', 'Modifier un utilisateur')

@section('content')
	<div class="row">
		<div class="col-6 grid-margin stretch-card">
	        <div class="card">
	          <div class="card-body">
	            <h4 class="card-title">Modifier un administrateur</h4>
	            <p class="card-description"> &ndash; Un administrateur peut tout gérer </p>
	            <form class="forms-sample">
	              <div class="form-group">
	                <label for="name">Nom</label>
	                <input type="text" class="form-control" placeholder="Nom" name="name" required>
	              </div>
	              <div class="form-group">
	                <label for="surname">Prénom(s)</label>
	                <input type="text" class="form-control" placeholder="Prénom" name="surname" required>
	              </div>
	              <div class="form-group">
	                <label for="email">Adresse email</label>
	                <input type="email" class="form-control" name="email" placeholder="Adresse email" required>
	              </div>
	              <div class="form-group">
	                <label for="phone">Téléphone</label>
	                <input type="teL" class="form-control" name="phone" placeholder="Numéro de téléphone" required>
	              </div>
	              <div class="form-group">
	                <label for="exampleSelectGender">Sexe</label>
	                <select class="form-control" name="sex" required>
                      <option default hidden>-- Sélectionner le sexe --</option>
                      <option value="F">Féminin</option>
                      <option value="M">Masculin</option>
                    </select>
	              </div>
	           
	              <button type="submit" class="btn btn-primary mr-2">Modifier</button>
	              <button class="btn btn-light">Annuler</button>
	            </form>
	          </div>
	        </div>
	      </div>
	  </div>
@endsection