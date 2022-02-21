@extends('back.layouts.dash')

@section('title', 'Liste des centres de traitement')

@section('pageTitle', 'Liste des centres de traitement')

@section('content')
	<div class="row">
		<div class="col-12 grid-margin stretch-card">
	        <div class="card">
	          <div class="card-body">
	            <h4 class="card-title">Liste des centres de traitement</h4>
	            <p class="card-description"> &ndash; Un centre de traitement est une ambassade, un consulat</p>
	            <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th> # </th>
                      <th> Désignation </th>
                      <th> Pays concernés </th>
                      <th> Actions </th>
                    </tr>
                  </thead>
                  <tbody>
                  	@forelse($centers as $index => $center)
                    <tr>
                      <td style="font-size: 12px"> {{ ++$index }} </td>
                      <td style="font-size: 12px"> {{ $center->name }} </td>
                      <td>
                        @foreach(explode(',', $center->countries_for) as $index => $country) 
                          <span class="country">
                              {{ getCountry($country) }}
                          </span> &nbsp;
                        @endforeach
                      </td>
                      <td>
                      	{{--<a href="#" class="text-primary">Consulter</a>
                      	<a href="#" class="text-dark">Modifier</a>
                      	@role('admin')
                      		<a href="#" class="text-danger">Supprimer</a>
                      	@endrole--}}
                        <div class="dropdown actions">
                          <button class="btn btn-white dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#"><i class="fas fa-eye"></i> Consulter</a>
                            <a class="dropdown-item text-info" href="#"><i class="far fa-edit"></i> Modifier</a>
                            @hasanyrole('admin|super-admin')
                              <a class="dropdown-item text-danger" href="#"><i class="fas fa-lock"></i> Suspendre</a>
                            @endrole
                          </div>
                        </div>
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