@extends('front.layouts.front')

@section('title', 'Statut de votre demande')

@section('content')
	<div id="applyStatus" class="container px-5 page" style="margin-top: 5em">
		<div class="row">
			<div class="col-12">
				<h1 style="font-size: 18px;">Statut de vos demandes</h1>
			</div>
		</div>

		<div class="row mt-4">
			<div class="col-lg-6">
				<div class="accordion" id="stories">
					@forelse($dossiers as $index => $dossier)	
					  <div class="accordion-item">
					    <h2 class="accordion-header" id="transaction{{ $index }}">
					      <button class="accordion-button {{ $index != 0 ? 'collapsed' : '' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $index }}" aria-expanded="{{ $index != 0 ? 'false' : 'true' }}" aria-controls="collapse{{ $index }}">
					      	@if($index == 0)
					        	Dernier dossier
					        @else
					        	EV-{{ $dossier->created_at->format('dmY') }}{{ str_pad($dossier->id, 5, "0", STR_PAD_LEFT) }}
					        @endif
					      </button>
					    </h2>
					    <div id="collapse{{ $index }}" class="accordion-collapse collapse {{ $index == 0 ? 'show' : '' }}" aria-labelledby="transaction{{ $index }}" data-bs-parent="#accordionExample">
					      <div class="accordion-body">
					        <div class="row">
					        	<div class="col-4 title">Num Dossier</div>
					        	<div class="col-8 value">EV-{{ $dossier->created_at->format('dmY') }}{{ str_pad($dossier->id, 5, "0", STR_PAD_LEFT) }}</div>
					        </div>
					        <div class="row">
					        	<div class="col-4 title">Statut</div>
					        	<div class="col-8 value">
					        		@if ($dossier->state != "")
									  @foreach(array_reverse(explode(',', $dossier->state)) as $status) 
									    <p>
									    	@foreach(explode('*', $status) as $index => $s) 
										    	<span class="{{ $index == 0 ? 'status' : 'createdAt' }}">
										    		@if($index == 0)
										    			@switch($s)
															@case(10)
														        En cours
														        @break
														    @case(20)
														        <span class="text-success">Approuvé</span>
														        @break
														    @case(30)
														        <span class="text-success">Contrôlé</span>
														        @break
														    @case(40)
														        <span class="text-success">Finalisé</span>
														        @break
														    @default
														        <span class="text-danger">Refusé</span>
										    			@endswitch
											    	@else
											    		&nbsp; le {{ $s }}
											    	@endif
										    	</span>
										    @endforeach
									    </p>
									  @endforeach
									@endif
					        	</div>
					        </div>
					      </div>
					    </div>
					  </div>
					@empty
						<p class="p-3 bg bg bg-primary text-white">Vous n'avez pas encore effectué de demande de visa</p>
					@endif
				</div>
			</div>
		</div>
	</div>
@endsection