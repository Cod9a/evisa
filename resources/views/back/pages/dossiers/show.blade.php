@extends('back.layouts.dash')

@section('title', 'Consulter un dossier')

@section('pageTitle', 'Consulter un dossier')

@section('content')
	<div class="row">
		<div class="col-12 grid-margin stretch-card">
	     <div class="card">
	       <div class="card-body">
            <div class="row mt-4">
              <div class="col-lg-6 sectionInfos">
                <div class="accordion" id="stories">
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="infosDossier">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseDossier" aria-expanded="false" aria-controls="collapseDossier">
                            Informations sur le dossier
                        </button>
                      </h2>
                      <div id="collapseDossier" class="accordion-collapse collapse show" aria-labelledby="infosDossier" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                          <div class="row">
                            <div class="col-4 title">Num Dossier</div>
                            <div class="col-8 value">EV-{{ $dossier->created_at->format('dmY') }}{{ str_pad($dossier->id + 338, 5, "0", STR_PAD_LEFT) }}</div>
                          </div>
                          <div class="row">
                            <div class="col-4 title">Paiement ID</div>
                            <div class="col-8 value">{{ $dossier->transaction_id }}</div>
                          </div>
                          <div class="row">
                            <div class="col-4 title">Statut(s)</div>
                              <div class="col-8 value">
                                @forelse(array_reverse(explode(',', $dossier->state)) as $status) 
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
                                @empty
                                  <p class="p-3 bg bg bg-primary text-white">Aucune donnée</p>
                                @endforelse
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-4 title">Type de visa</div>
                            <div class="col-8 value">{{ $dossier->type_visa->name }}</div>
                          </div>
                          <div class="row">
                            <div class="col-4 title">Provenance</div>
                            <div class="col-8 value">{{ getCountry($dossier->provenance) }}</div>
                          </div>
                          <div class="row">
                            <div class="col-4 title">Motif</div>
                            <div class="col-8 value">{{ $dossier->motif }}</div>
                          </div>
                          <div class="row">
                            <div class="col-4 title">Centre de traitement</div>
                            <div class="col-8 value">{{ $dossier->center->name }}</div>
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
              </div>
              @hasanyrole('admin|super-admin|agent|frontal-agent')
                <div class="col-lg-6 sectionInfos">
                  <div class="accordion" id="stories">
                      <div class="accordion-item">
                        <h2 class="accordion-header" id="infosClient">
                          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseClient" aria-expanded="false" aria-controls="collapseClient">
                              Informations sur le demandeur
                          </button>
                        </h2>
                        <div id="collapseClient" class="accordion-collapse collapse show" aria-labelledby="infosClient" data-bs-parent="#accordionExample">
                          <div class="accordion-body">
                            <div class="row">
                              <div class="col-4 title">Nom & Prénom(s)</div>
                              <div class="col-8 value">{{ $dossier->user->name }} {{ $dossier->user->surname }}</div>
                            </div>
                            <div class="row">
                              <div class="col-4 title">Email</div>
                              <div class="col-8 value">{{ $dossier->user->email }}</div>
                            </div>
                            <div class="row">
                              <div class="col-4 title">Sexe</div>
                              <div class="col-8 value">
                                @if($dossier->user->sex == 'M')
                                  Masculin
                                @else
                                  Féminin
                                @endif
                              </div>
                            </div>
                            <div class="row">
                              <div class="col-4 title">Nationalité</div>
                              <div class="col-8 value">{{ getCountry($dossier->user->country) }}</div>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
                </div>
              @endhasanyrole
              <div class="col-lg-12 sectionInfos">
                <div class="accordion" id="stories">
                    <div class="accordion-item">
                      <h2 class="accordion-header" id="infosFiles">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFiles" aria-expanded="false" aria-controls="collapseFiles">
                            Fichiers soumis
                        </button>
                      </h2>
                      <div id="collapseFiles" class="accordion-collapse collapse show" aria-labelledby="infosFiles" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                          <div class="row">
                            <div class="col-4 title">Passeport</div>
                            <div class="col-8 value">
                              <a href="{{ asset((!\App::environment('local') ? 'public/' : '') . "storage/$dossier->passport") }}" class="mr-2" target="_blank"><i class="far fa-eye"></i> Consulter</a>
                              @hasanyrole('admin|super-admin|agent|frontal-agent')
                                @if(strpos($dossier->validatedFiles, 'passport') !== false)
                                    <span class="text-success status"><i class="fas fa-check"></i> Validé</span>
                                @else
                                  @if(strpos($dossier->state, '20*') !== false)
                                    <a href="{{ route('dossiers.validatedFiles', ['file' => 'passport', 'dossier' => $dossier, 'token' => $dossier->token]) }}" class="text-success"><i class="fas fa-check"></i> Valider</a>
                                  @endif
                                @endif
                              @endhasanyrole
                              <div>
                                <iframe src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/' . $dossier->passport) }}" class="mt-2" style=""></iframe>
                              </div>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col-4 title">Numero</div>
                            <div class="col-8 value">{{ $dossier->passport_num }}</div>
                          </div>
                          <div class="row">
                            <div class="col-4 title">Type</div>
                            <div class="col-8 value">{{ ucfirst($dossier->passport_type) }}</div>
                          </div>
                          <div class="row">
                            <div class="col-4 title">Expire le</div>
                            <div class="col-8 value">{{ date('d/m/Y', strtotime($dossier->passport_expiration)) }}</div>
                          </div>
                          @if($dossier->ticket)
                            <div class="row">
                              <div class="col-4 title">Réservation de billet d'avion</div>
                              <div class="col-8 value">
                                <a href="{{ asset((!\App::environment('local') ? 'public/' : '') . "storage/$dossier->ticket") }}" class="mr-2" target="_blank"><i class="far fa-eye"></i> Consulter</a>
                                @hasanyrole('admin|super-admin|agent|frontal-agent')
                                  @if(strpos($dossier->validatedFiles, 'ticket') !== false)
                                      <span class="text-success status"><i class="fas fa-check"></i> Validé</span>
                                  @else
                                    @if(strpos($dossier->state, '20*') !== false)
                                      <a href="{{ route('dossiers.validatedFiles', ['file' => 'ticket', 'dossier' => $dossier, 'token' => $dossier->token]) }}" class="text-success"><i class="fas fa-check"></i> Valider</a>
                                    @endif
                                  @endif
                                @endhasanyrole
                                <div>
                                  <iframe src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/' . $dossier->ticket) }}" class="mt-2" style=""></iframe>
                                </div>
                              </div>
                            </div>
                          @endif

                          @if($dossier->accommodation)
                            <div class="row">
                              <div class="col-4 title">Attestation d'hébergement</div>
                              <div class="col-8 value">
                                <a href="{{ asset((!\App::environment('local') ? 'public/' : '') . "storage/$dossier->accommodation") }}" class="mr-2" target="_blank"><i class="far fa-eye"></i> Consulter</a>
                                @hasanyrole('admin|super-admin|agent|frontal-agent')
                                  @if(strpos($dossier->validatedFiles, 'accommodation') !== false)
                                      <span class="text-success status"><i class="fas fa-check"></i> Validé</span>
                                  @else
                                    @if(strpos($dossier->state, '20*') !== false)
                                      <a href="{{ route('dossiers.validatedFiles', ['file' => 'accommodation', 'dossier' => $dossier, 'token' => $dossier->token]) }}" class="text-success"><i class="fas fa-check"></i> Valider</a>
                                    @endif
                                  @endif
                                @endhasanyrole
                                <div>
                                  <iframe src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/' . $dossier->accommodation) }}" class="mt-2" style=""></iframe>
                                </div>
                              </div>
                            </div>
                          @endif

                          @if($dossier->hotel)
                            <div class="row">
                              <div class="col-4 title">Réservation d'hôtel</div>
                              <div class="col-8 value">
                                <a href="{{ asset((!\App::environment('local') ? 'public/' : '') . "storage/$dossier->hotel") }}" class="mr-2" target="_blank"><i class="far fa-eye"></i> Consulter</a>
                                @hasanyrole('admin|super-admin|agent|frontal-agent')
                                  @if(strpos($dossier->validatedFiles, 'hotel') !== false)
                                      <span class="text-success status"><i class="fas fa-check"></i> Validé</span>
                                  @else
                                    @if(strpos($dossier->state, '20*') !== false)
                                      <a href="{{ route('dossiers.validatedFiles', ['file' => 'hotel', 'dossier' => $dossier, 'token' => $dossier->token]) }}" class="text-success"><i class="fas fa-check"></i> Valider</a>
                                    @endif
                                  @endif
                                @endhasanyrole
                                <div>
                                  <iframe src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/' . $dossier->hotel) }}" class="mt-2" style=""></iframe>
                                </div>
                              </div>
                            </div>
                          @endif

                          @if($dossier->work)
                            <div class="row">
                              <div class="col-4 title">Contrat de travail</div>
                              <div class="col-8 value">
                                <a href="{{ asset((!\App::environment('local') ? 'public/' : '') . "storage/$dossier->work") }}" class="mr-2" target="_blank"><i class="far fa-eye"></i> Consulter</a>
                                @hasanyrole('admin|super-admin|agent|frontal-agent')
                                  @if(strpos($dossier->validatedFiles, 'work') !== false)
                                      <span class="text-success status"><i class="fas fa-check"></i> Validé</span>
                                  @else
                                    @if(strpos($dossier->state, '20*') !== false)
                                      <a href="{{ route('dossiers.validatedFiles', ['file' => 'work', 'dossier' => $dossier, 'token' => $dossier->token]) }}" class="text-success"><i class="fas fa-check"></i> Valider</a>
                                    @endif
                                  @endif
                                @endhasanyrole
                                <div>
                                  <iframe src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/' . $dossier->work) }}" class="mt-2" style=""></iframe>
                                </div>
                              </div>
                            </div>
                          @endif

                          @if($dossier->mission)
                            <div class="row">
                              <div class="col-4 title">Lettre de mission</div>
                              <div class="col-8 value">
                                <a href="{{ asset((!\App::environment('local') ? 'public/' : '') . "storage/$dossier->mission") }}" class="mr-2" target="_blank"><i class="far fa-eye"></i> Consulter</a>
                                @hasanyrole('admin|super-admin|agent|frontal-agent')
                                  @if(strpos($dossier->validatedFiles, 'mission') !== false)
                                      <span class="text-success status"><i class="fas fa-check"></i> Validé</span>
                                  @else
                                    @if(strpos($dossier->state, '20*') !== false)
                                      <a href="{{ route('dossiers.validatedFiles', ['file' => 'mission', 'dossier' => $dossier, 'token' => $dossier->token]) }}" class="text-success"><i class="fas fa-check"></i> Valider</a>
                                    @endif
                                  @endif
                                @endhasanyrole
                                <div>
                                  <iframe src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/' . $dossier->mission) }}" class="mt-2" style=""></iframe>
                                </div>
                              </div>
                            </div>
                          @endif

                          @if($dossier->imposition)
                            <div class="row">
                              <div class="col-4 title">Avis d'imposition</div>
                              <div class="col-8 value">
                                <a href="{{ asset((!\App::environment('local') ? 'public/' : '') . "storage/$dossier->imposition") }}" class="mr-2" target="_blank"><i class="far fa-eye"></i> Consulter</a>
                                @hasanyrole('admin|super-admin|agent|frontal-agent')
                                  @if(strpos($dossier->validatedFiles, 'imposition') !== false)
                                      <span class="text-success status"><i class="fas fa-check"></i> Validé</span>
                                  @else
                                    @if(strpos($dossier->state, '20*') !== false)
                                      <a href="{{ route('dossiers.validatedFiles', ['file' => 'imposition', 'dossier' => $dossier, 'token' => $dossier->token]) }}" class="text-success"><i class="fas fa-check"></i> Valider</a>
                                    @endif
                                  @endif
                                @endhasanyrole
                                <div>
                                  <iframe src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/' . $dossier->imposition) }}" class="mt-2" style=""></iframe>
                                </div>
                              </div>
                            </div>
                          @endif
                          <div class="row">
                            <!-- <a href="#" class="btn btn-primary ml-2"><i class="fas fa-check-double"></i> Tout valider</a> -->
                          </div>
                        </div>
                      </div>
                    </div>
                </div>
              </div>
              @if(strpos($dossier->state, '40*') !== false)
                <div class="col-lg-6 sectionInfos">
                  <div class="accordion" id="stories">
                      <div class="accordion-item">
                        <h2 class="accordion-header" id="infosVisa">
                          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseVisa" aria-expanded="false" aria-controls="collapseVisa">
                              Informations sur le visa
                          </button>
                        </h2>
                        <div id="collapseVisa" class="accordion-collapse collapse show" aria-labelledby="infosVisa" data-bs-parent="#accordionExample">
                          <div class="accordion-body">
                            <div class="row">
                              <div class="col-4 title">Num Vignette</div>
                              <div class="col-8 value">{{ $dossier->visa_id }}</div>
                            </div>
                            <div class="row">
                              <div class="col-4 title">Délivré le</div>
                              <div class="col-8 value">{{ date('d/m/Y', strtotime($dossier->delivered_date)) }}</div>
                            </div>
                            <div class="row">
                              <div class="col-4 title">Expire le</div>
                              <div class="col-8 value">{{ date('d/m/Y', strtotime($dossier->delivered_date)) }}</div>
                            </div>
                          </div>
                        </div>
                      </div>
                  </div>
                </div>
              @endif
            </div>
            <div class="actions">
              @hasanyrole('admin|super-admin|agent|frontal-agent')
                <a href="{{ route('dossiers.index') }}" class="btn btn-secondary"><i class="fas fa-eject"></i> Annuler</a>
                @if(strpos($dossier->state, '20*') == false && strpos($dossier->state, '70*') == false)
                  <a href="#" class="btn btn-dark"><i class="fas fa-exclamation-triangle"></i> Demander des renseignements</a>
                @endif
                @if(strpos($dossier->state, '20*') == false && strpos($dossier->state, '70*') == false)
                  <a href="{{ route('dossiers.setState', ['dossier' => $dossier, 'state' => 20, 'token' => $dossier->token]) }}" class="btn btn-success"><i class="fas fa-clipboard-check"></i> Approuver</a>
                @endif
                @hasanyrole('admin|super-admin|frontal-agent')
                  @if(strpos($dossier->state, '30*') == false && strpos($dossier->state, '20*') !== false)
                    <a href="{{ route('dossiers.setState', ['dossier' => $dossier, 'state' => 30, 'token' => $dossier->token]) }}" class="btn btn-success"><i class="fas fa-undo"></i> Contrôler</a>
                  @endif
                  @if(strpos($dossier->state, '40*') == false && strpos($dossier->state, '30*') !== false)
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#finalisedModal"><i class="fas fa-door-closed"></i> Finaliser</button>
                    <!-- <a href="{{ route('dossiers.setState', ['dossier' => $dossier, 'state' => 40, 'token' => $dossier->token]) }}" class="btn btn-success"><i class="fas fa-door-closed"></i> Finaliser</a> -->
                  @endif
                @endhasanyrole
                @if(strpos($dossier->state, '70*') == false && strpos($dossier->state, '20*') == false)
                  <a href="{{ route('dossiers.setState', ['dossier' => $dossier, 'state' => 70, 'token' => $dossier->token]) }}" class="btn btn-danger"><i class="fas fa-lock"></i> Refuser</a>
                @endif
              @endhasanyrole
            </div>
	          </div>
	        </div>
	      </div>
	  </div>


<div class="modal fade" id="finalisedModal" tabindex="-1" role="dialog" aria-labelledby="FinalisedLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="FinalisedLabel">Remplissez les informations du visa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('dossiers.finalised', $dossier) }}" method="post" id="finalised_form">
          @csrf
          <div class="form-group">
            <label for="name">N° Vignette</label>
            <input type="text" class="form-control" placeholder="Numero vignette" name="num_visa" required>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Délivré le:</label>
            <input type="date" class="form-control" name="delivered_date" required>
          </div>
          <div class="form-group">
            <label for="message-text" class="col-form-label">Expire le:</label>
            <input type="date" class="form-control" name="expired_date" required>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <button type="submit" class="btn btn-primary" onclick="form_submit()"><i class="fas fa-door-closed"></i> Finaliser</button>
      </div>
    </div>
  </div>
</div>
@endsection

@section('customScripts')
<script type="text/javascript">
  function form_submit() {
    document.getElementById("finalised_form").submit();
  }
</script>
  
@endsection