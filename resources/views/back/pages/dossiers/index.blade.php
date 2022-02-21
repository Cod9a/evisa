@extends('back.layouts.dash')

@section('title', 'Liste des dossiers')

@section('pageTitle', 'Liste des dossiers')

@section('content')
	<div class="row">
		<div class="col-12 grid-margin stretch-card">
	        <div class="card">
	          <div class="card-body">
	            <h4 class="card-title text-lowercase">
                <span class="text-uppercase">L</span>iste des dossiers 
                @if($state == 10)
                  en cours
                @elseif($state == 70)
                  rejetés
                @elseif($state == 20)
                  approuvés
                @elseif($state == 30)
                  contrôlés
                @elseif($state == 40)
                  finalisés
                @else
                  
                @endif
              </h4>
	            <div class="actions row">
                <div class="actions1 col-lg-12 text-right">
                  <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-filter"></i> Filtre
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a href="{{ route('dossiers.index') }}" class="dropdown-item text-primary">Tous</a>
                      <a href="{{ route('dossiers.index', 10) }}" class="dropdown-item">En cours</a>
                      <a href="{{ route('dossiers.index', 20) }}" class="dropdown-item text-success">Approuvés</a>
                      <a href="{{ route('dossiers.index', 30) }}" class="dropdown-item text-success">Contrôlés</a>
                      <a href="{{ route('dossiers.index', 40) }}" class="dropdown-item text-success">Finalisés</a>
                      <a href="{{ route('dossiers.index', 70) }}" class="dropdown-item text-danger">Refusés</a>
                    </div>
                  </div>
                </div>
              </div>
	            <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th class="text-left" style="width: 150px"> Numero dossier </th>
                      <th> Demandeur </th>
                      <th> Etat </th>
                      <th> Type visa </th>
                      <th> Actions </th>
                    </tr>
                  </thead>
                  <tbody>
                  	@forelse($dossiers as $index => $dossier)
                    <tr>
                      <td class="text-left" style="font-size: 12px">EV-{{ $dossier->created_at->format('dmY') }}{{ str_pad($dossier->id + 338, 5, "0", STR_PAD_LEFT) }}</td>
                      <td style="font-size: 12px"> {{ $dossier->user->name }} {{ $dossier->user->surname }} </td>
                      <td style="font-size: 12px">
                       @foreach(array_reverse(explode(',', $dossier->state)) as $status)
                        @if($loop->first)
                           @foreach(explode('*', $status) as $index => $s) 
                          <span class="{{ $index == 0 ? 'status' : 'createdAt' }}">
                            @if($index == 0)
                              @switch($s)
                              @case(10)
                                    En cours
                                    @break
                                @case(20)
                                    Approuvé
                                    @break
                                @case(30)
                                    Contrôlé
                                    @break
                                @case(40)
                                    Finalisé
                                    @break
                                @default
                                    Refusé
                              @endswitch
                            @endif
                          </span>
                        @endforeach
                        @endif 
                       @endforeach
                      </td>
                      <td style="font-size: 12px"> {{ $dossier->type_visa->name }} </td>
                      <td style="font-size: 12px">
                      	<div class="dropdown actions">
                          <button class="btn btn-white dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a href="{{ route('dossiers.show', ['dossier' => $dossier, 'token' => $dossier->token]) }}" class="dropdown-item text-primary"><i class="fas fa-eye"></i> Consulter</a>
                            <!-- <a class="dropdown-item text-info" href="#"><i class="far fa-edit"></i> Modifier</a> -->
                            {{--@hasanyrole('admin|super-admin')
                              <a class="dropdown-item text-danger" href="#"><i class="fas fa-lock"></i> Désactiver</a>
                            @endhasanyrole--}}
                          </div>
                        </div>
                      </td>
                    </tr>
                    @empty
                    	<tr><td class="text-left p-3" colspan="5">Pas d'enregistrement</td></tr>
                    @endforelse
                  </tbody>
                </table>
	          </div>
	        </div>
	      </div>
	  </div>
@endsection