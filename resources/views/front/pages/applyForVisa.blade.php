@extends('front.layouts.front')

@section('title', 'Demande de visa')

@section('content')
	<div id="applyForVisa" class="container px-5 page" style="margin-top: 5em">
		<div class="row">
			<div class="col-12">
				<h1>Formulaire de demande de visa</h1>
			</div>
		</div>

		<form method="POST" action="{{ route('apply.submit') }}" class="applyForVisa row" enctype="multipart/form-data">
			@csrf
			<div class="form-group col-lg-4">
				<label for="name">Type de visa demandé</label>
	            <select class="form-control type_visa" name="type_visa" required>
					<option default hidden>-- Sélectionner le type de visa --</option>
                  	@foreach(getTypeVisas() as $item)
                    	<option value="{{ $item->id }}" {{ old('type_visa') == $item->id  ? 'selected' : '' }}>{{ $item->name }}</option>
                  	@endforeach
                  	@error('type_visa')
	                  <p class="text-sm text-danger">{{ $message }}</p>
	              	@enderror
                </select>
			</div>
			<div class="form-group col-lg-4">
				<label for="passport_type">Type de passeport</label>
				<select name="passport_type" class="form-control" required>
					<option default hidden>-- Sélectionner le type de passeport --</option>
					<option value="service" {{ 'service' == old('passport_type') ? 'selected' : '' }}>Passeport de service</option>
					<option value="diplomatique" {{ 'diplomatique' == old('passport_type') ? 'selected' : '' }}>Passeport diplomatique</option>
					<option value="national" {{ 'national' == old('passport_type') ? 'selected' : '' }}>Passeport national</option>
				</select>
				@error('passport_type')
                  <p class="text-sm text-danger">{{ $message }}</p>
              	@enderror
			</div>
			<div class="form-group col-lg-4">
				<label for="passport_num">Numéro de passeport</label>
				<input type="text" class="form-control" name="passport_num" value="{{ old('passport_num') }}" placeholder="Entrer le numéro de passeport" required>
				@error('passport_num')
                  <p class="text-sm text-danger">{{ $message }}</p>
              	@enderror
			</div>
			<div class="form-group col-lg-4">
				<label for="passport_expiration">Date d'expiration du passeport</label>
				<input type="date" class="form-control" value="{{ old('passport_expiration') }}" name="passport_expiration" required>
				@error('passport_expiration')
                  <p class="text-sm text-danger">{{ $message }}</p>
              	@enderror
			</div>
			<div class="form-group col-lg-4">
				<label for="provenance">Provenance</label>
				<select name="provenance" class="form-control" required>
					<option default hidden>-- Sélectionner la provenance --</option>
					@foreach(getCountries() as $country)
	                    <option value="{{ $country->code }}" {{ $country->code == old('provenance') ? 'selected' : '' }}>{{ $country->name }}</option>
	                @endforeach
				</select>
				@error('provenance')
                  <p class="text-sm text-danger">{{ $message }}</p>
              	@enderror
			</div>
			<div class="form-group col-lg-4">
				<label for="motif">Motif de voyage</label>
				<input type="text" class="form-control"  value="{{ old('motif') }}" name="motif" placeholder="Motif de voyage" required>
				@error('motif')
                  <p class="text-sm text-danger">{{ $message }}</p>
              	@enderror
			</div>
			
			<div class="mt-4">
				<fieldset class="row">
    				<legend>Fichiers à soumettre</legend>
    				<div class="form-group col-lg-4 passport">
						<label for="passport">Passeport</label>
						<input type="file" class="form-control" name="passport" required>
						@error('passport')
		                  <p class="text-sm text-danger">{{ $message }}</p>
		              	@enderror
					</div>
					<div class="form-group col-lg-4 ticket">
						<label for="ticket">Réservation billet d'avion</label>
						<input type="file" class="form-control" name="ticket">
						@error('ticket')
		                  <p class="text-sm text-danger">{{ $message }}</p>
		              	@enderror
					</div>
					<div class="form-group col-lg-4 accommodation">
						<label for="accommodation">Attestation hébergement</label>
						<input type="file" class="form-control" name="accommodation">
						@error('accommodation')
		                  <p class="text-sm text-danger">{{ $message }}</p>
		              	@enderror
					</div>
					<div class="form-group col-lg-4 hotel">
						<label for="hotel">Réservation hôtel</label>
						<input type="file" class="form-control" name="hotel">
						@error('hotel')
		                  <p class="text-sm text-danger">{{ $message }}</p>
		              	@enderror
					</div>
					<div class="form-group col-lg-4 mission">
						<label for="mission">Lettre de mission</label>
						<input type="file" class="form-control" name="mission">
						@error('mission')
		                  <p class="text-sm text-danger">{{ $message }}</p>
		              	@enderror
					</div>
					<div class="form-group col-lg-4 work">
						<label for="work">Contrat de travail</label>
						<input type="file" class="form-control" name="work">
						@error('work')
		                  <p class="text-sm text-danger">{{ $message }}</p>
		              	@enderror
					</div>
					<div class="form-group col-lg-4 imposition">
						<label for="imposition">Avis d'imposition</label>
						<input type="file" class="form-control" name="imposition">
						@error('imposition')
		                  <p class="text-sm text-danger">{{ $message }}</p>
		              	@enderror
					</div>
    			</fieldset>
			</div>
			<div class="form-group">
				<input type="submit" class="btn btn-primary" value="Soumettre la demande de visa">
			</div>
		</form>
	</div>
@endsection

@section('customScripts')
	<script>
	    let type_visa = document.querySelector('.type_visa');

	    let passport = document.querySelector('fieldset .passport')
	    let ticket = document.querySelector('fieldset .ticket')
	    let accommodation = document.querySelector('fieldset .accommodation')
	    let hotel = document.querySelector('fieldset .hotel')
	    let mission = document.querySelector('fieldset .mission')
	    let work = document.querySelector('fieldset .work')
	    let imposition = document.querySelector('fieldset .imposition')


        type_visa.addEventListener('change', function () {
            let visaValue = type_visa.value;
            if(visaValue == 1) {
            	passport.classList.add('show')
            	ticket.classList.add('show')
            	accommodation.classList.add('show')
            	hotel.classList.add('show')
            	mission.classList.remove('show')
            	work.classList.remove('show')
            	imposition.classList.remove('show')
            }
            if(visaValue == 2) {
            	passport.classList.add('show')
            	mission.classList.add('show')
            	work.classList.add('show')
            	accommodation.classList.add('show')
            	imposition.classList.add('show')
            	ticket.classList.remove('show')
            	hotel.classList.remove('show')
            }
            if(visaValue == 3) {
            	passport.classList.add('show')
            	work.classList.add('show')
            	accommodation.classList.add('show')
            	ticket.classList.remove('show')
            	hotel.classList.remove('show')
            	mission.classList.remove('show')
            	imposition.classList.remove('show')
            }
        });

        if("{{ old('type_visa') }}") {
        	if("{{ old('type_visa') }}" == 1) {
            	passport.classList.add('show')
            	ticket.classList.add('show')
            	accommodation.classList.add('show')
            	hotel.classList.add('show')
            	mission.classList.remove('show')
            	work.classList.remove('show')
            	imposition.classList.remove('show')
            }
            if("{{ old('type_visa') }}" == 2) {
            	passport.classList.add('show')
            	mission.classList.add('show')
            	work.classList.add('show')
            	accommodation.classList.add('show')
            	imposition.classList.add('show')
            	ticket.classList.remove('show')
            	hotel.classList.remove('show')
            }
            if("{{ old('type_visa') }}" == 3) {
            	passport.classList.add('show')
            	work.classList.add('show')
            	accommodation.classList.add('show')
            	ticket.classList.remove('show')
            	hotel.classList.remove('show')
            	mission.classList.remove('show')
            	imposition.classList.remove('show')
            }
        }
    </script>
@endsection