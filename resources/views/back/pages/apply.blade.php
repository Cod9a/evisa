@extends('back.layouts.dash')

@section('title', 'Demande de visa')

@section('pageTitle', 'Demande de visa')

@section('content')
	<div class="row">
		<div class="col-8 grid-margin stretch-card">
	        <div class="card">
	          <div class="card-body">
	            <h4 class="card-title">Effectuez votre demande de visa à travers ce formulaire</h4>
	            <form class="forms-sample" method="post" action="{{ route('apply.submit') }}" enctype="multipart/form-data">
	              @csrf
	              <div class="form-group">
	                <label for="typeVisa">Type de visa</label>
	                <select class="form-control" name="type_visa_id" required>
                      <option default hidden>-- Sélectionner le type de visa --</option>
                      @foreach(getTypeVisas() as $item)
                        <option value="{{ $item->id }}" {{ $item->id == old('type_visa_id') ? 'checked' : '' }}>{{ $item->name }}</option>
                      @endforeach
                    </select>
	                @error('type_visa_id')
	                  <p class="text-sm text-red-600">{{ $message }}</p>
	              	@enderror
	              </div>
	              <div class="form-group">
	                <label for="destination">Votre destination</label>
                    <select name="destination" required class="form-control form-control-lg @error('destination') is-invalid @enderror">
                      <option default hidden>-- Sélectionner votre destination --</option>
                      @foreach(getCountries() as $destination)
                        <option value="{{ $destination->code }}" {{ $destination->code == old('destination') ? 'checked' : '' }}>{{ $destination->name }}</option>
                      @endforeach
                    </select>
                    @error('destination')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
	              <div class="form-group">
	                <label>Pièce d'dentité</label>
	                <input type="file" name="card" required placeholder="Votre pièce d'identité" class="form-control">
                    @error('card')
	                  <p class="text-sm text-red-600">{{ $message }}</p>
	              	@enderror
	              </div>
	              <div class="form-group">
	                <label>Justificatif de logement</label>
	                <input type="file" name="lodging" required placeholder="Votre justificatif de logement" class="form-control">
                    @error('lodging')
	                  <p class="text-sm text-red-600">{{ $message }}</p>
	              	@enderror
	              </div>
	              <div class="form-group">
	                <label>Description du voyage</label>
	                <textarea name="description" rows=10 required placeholder="Description du voyage" class="form-control">{{ old('description')}}</textarea>
                    @error('description')
	                  <p class="text-sm text-red-600">{{ $message }}</p>
	              	@enderror
	              </div>
	           
	              <button type="submit" class="btn btn-primary mr-2">Soumettre</button>
	              <a class="btn btn-light" href="#">Annuler</a>
	            </form>
	          </div>
	        </div>
	      </div>
	  </div>
@endsection