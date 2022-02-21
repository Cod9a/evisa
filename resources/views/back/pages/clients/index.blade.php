@extends('back.layouts.dash')

@section('title', 'Liste des clients')

@section('pageTitle', 'Liste des clients')

@section('content')
	<div class="row">
		<div class="col-12 grid-margin stretch-card">
	        <div class="card">
	          <div class="card-body">
	            <h4 class="card-title">Liste des clients</h4>

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
                  @forelse($clients as $index => $client)
                  <tr>
                    <td style="font-size: 12px"> {{ ++$index }} </td>
                    <td style="font-size: 12px"> {{ $client->name }} {{ $client->surname }} </td>
                    <td style="font-size: 12px"> {{ $client->email }} </td>
                    <td> <span class="country">{{ getCountry($client->country) }}</span> </td>
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
              <div class="d-flex justify-content-end mt-4">{{ $clients->links() }}</div>
	          </div>
	        </div>
	      </div>
	  </div>
@endsection