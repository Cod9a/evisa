@extends('back.layouts.dash')

@section('title', 'Liste des utilisateurs')

@section('pageTitle', 'Liste des utilisateurs')

@section('content')
	<div class="row">
		<div class="col-12 grid-margin stretch-card">
	        <div class="card">
	          <div class="card-body">
	            <h4 class="card-title">
                Liste  
                <span class="text-lowercase">
                  des 
                  @if($role == 'super-admin')
                    supers administrateurs
                  @elseif($role == 'admin')
                    administrateurs
                  @elseif($role == 'frontal-agent')
                    agents frontaliers
                  @elseif($role == 'agent')
                    agents
                  @else
                    utilisateurs
                  @endif
                </span>
              </h4>
              <div class="actions row">
                <div class="actions1 col-lg-8">
                  <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-filter"></i> Filtre
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a href="{{ route('users.index') }}" class="btn {{ $role == null ? 'btn-primary' : 'btn-secondary' }}">Tous</a>
                      <a href="{{ route('users.index', 'super-admin') }}" class="btn  {{ $role == 'super-admin' ? 'btn-primary' : 'btn-secondary' }}">Super admins</a>
                      <a href="{{ route('users.index', 'admin') }}" class="btn  {{ $role == 'admin' ? 'btn-primary' : 'btn-secondary' }}">Administrateurs</a>
                      <a href="{{ route('users.index', 'agent') }}" class="btn  {{ $role == 'agent' ? 'btn-primary' : 'btn-secondary' }}">Agents</a>
                      <a href="{{ route('users.index', 'frontal-agent') }}" class="btn  {{ $role == 'frontal-agent' ? 'btn-primary' : 'btn-secondary' }}">Agents frontaliers</a>
                    </div>
                  </div>
                  
                </div>
                <div class="actions2 col-lg-4 text-right">
                  <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-plus-circle"></i> Ajouter un 
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item" href="{{ route('users.create', 'agent') }}">Agent</a>
                      <a class="dropdown-item" href="{{ route('users.create', 'frontal-agent') }}">Agent frontalier</a>
                      <a class="dropdown-item" href="{{ route('users.create', 'admin') }}">Administrateur</a>
                      <a class="dropdown-item" href="{{ route('users.create', 'super-admin') }}">Super admin</a>
                    </div>
                  </div>
                </div>
              </div>
	            <!-- <p class="card-description"> &ndash; Un centre de traitement est une ambassade, un consulat</p> -->
	            <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th> # </th>
                      <th> Nom & Prénom(s) </th>
                      <th> Email </th>
                      <th> Rôles </th>
                      <th> Nationalité </th>
                      <th> Actions </th>
                    </tr>
                  </thead>
                  <tbody>
                  	@forelse($users as $index => $user)
                    <tr>
                      <td style="font-size: 12px"> {{ ++$index }} </td>
                      <td style="font-size: 12px"> {{ $user->name }} {{ $user->surname }} </td>
                      <td style="font-size: 12px"> {{ $user->email }} </td>
                      <td style="font-size: 12px"> 
                        @forelse($user->getRoleNames() as $index => $role)
                          @if($role != 'client')
                            <span class="role {{ $role == 'super-admin' ? 'admin' : ($role == 'admin' ? 'admin' : ($role == 'frontal-agent' ? 'agent' : 'agent')) }}">
                              {{ ucfirst($role) }}
                            </span> 
                          @endif
                        @empty
                          Pas de rôle
                        @endforelse
                      </td>
                      <td> <span class="country">{{ getCountry($user->country) }}</span> </td>
                      <td>
                      	<div class="dropdown actions">
                          <button class="btn btn-white dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#"><i class="fas fa-eye"></i> Consulter</a>
                            <a class="dropdown-item text-info" href="#"><i class="far fa-edit"></i> Modifier</a>
                            @hasanyrole('admin|super-admin')
                              <a class="dropdown-item text-danger" href="#"><i class="fas fa-lock"></i> Désactiver</a>
                            @endhasanyrole
                          </div>
                        </div>
                      </td>
                    </tr>
                    @empty
                    	<tr><td colspan="5">Pas d'enregistrement</td></tr>
                    @endforelse
                  </tbody>
                </table>
                <div class="d-flex justify-content-end mt-4">{{ $users->links() }}</div>
	          </div>
	        </div>
	      </div>
	  </div>
@endsection