@extends('back.layouts.dash')

@section('title', 'Liste des agents')

@section('pageTitle', 'Liste des agents')

@section('content')
	<div class="row">
		<div class="col-12 grid-margin stretch-card">
	        <div class="card">
	          <div class="card-body">
	            <h4 class="card-title">Liste des agents</h4>
	            <!-- <p class="card-description"> &ndash; Un centre de traitement est une ambassade, un consulat</p> -->
	            <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th> # </th>
                      <th> Nom & Prénom(s) </th>
                      <th> Email </th>
                      <th> Nationalité </th>
                      <th> Actions </th>
                    </tr>
                  </thead>
                  <tbody>
                  	@forelse($agents as $index => $agent)
                    <tr>
                      <td> {{ ++$index }} </td>
                      <td> {{ $agent->name }} {{ $agent->surname }} </td>
                      <td> {{ $agent->email }} </td>
                      <td> {{ getCountry($agent->country) }} </td>
                      <td>
                      	<a href="#" class="text-primary">Consulter</a>
                      	<a href="#" class="text-dark">Modifier</a>
                      	@role('admin')
                      		<a href="#" class="text-danger">Supprimer</a>
                      	@endrole
                      </td>
                    </tr>
                    @empty
                    	<tr><td colspan="5">Pas d'enregistrement</td></tr>
                    @endforelse
                  </tbody>
                </table>
	          </div>
	        </div>
	      </div>
	  </div>
@endsection