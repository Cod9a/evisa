<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item nav-profile">
      <a href="#" class="nav-link" style="margin-top: 5em;">
        <div class="profile-image">
          <i class="fas {{ Auth::user()->sex == 'M' ? 'fa-male' : 'fa-female' }} user text-primary"></i> 
          <div class="dot-indicator bg-success"></div>
        </div>
        <div class="text-wrapper">
          <p class="profile-name">{{ Auth::user()->surname }} {{ Auth::user()->name }}</p>
          <p class="designation">
            @if(Auth::user()->hasRole('super-admin'))
              Super administrateur
            @elseif(Auth::user()->hasRole('admin'))
              Administrateur
            @elseif(Auth::user()->hasRole('frontal-agent'))
              Agent frontalier
            @elseif(Auth::user()->hasRole('agent'))
              Agent
            @else
              Client
            @endif
          </p>
        </div>
      </a>
    </li>
    <li class="nav-item nav-category">
      <span class="nav-link">Tableau de bord</span>
    </li>
    <li class="nav-item {{ Route::currentRouteName() == 'home' ? 'active' : '' }}">
      <a class="nav-link" href="{{ route('home') }}">
        <span class="menu-title">Tableau de bord</span>
        <i class="icon-screen-desktop menu-icon"></i>
      </a>
    </li>
    <li class="nav-item nav-category">
      <span class="nav-link">Visa</span>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{ route('applyForVisa') }}">
        <span class="menu-title">Demande de visa</span>
        <i class="icon-wallet menu-icon"></i>
      </a>
    </li>
      <li class="nav-item nav-category"><span class="nav-link">Gestion des dossiers</span></li>
      <li class="nav-item {{ Route::currentRouteName() == 'dossiers.index' || Route::currentRouteName() == 'dossiers.enCours' || Route::currentRouteName() == 'dossiers.attente' || Route::currentRouteName() == 'dossiers.rejected' || Route::currentRouteName() == 'dossiers.validated' ? 'active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#dossiers" aria-expanded="false" aria-controls="dossiers">
          <span class="menu-title">Dossiers</span>
          <i class="icon-docs menu-icon"></i>
        </a>
        <div class="collapse" id="dossiers">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('dossiers.index') }}"> Liste </a></li>
          </ul>
        </div>
      </li>
      @hasanyrole('agent|frontal-agent|admin|super-admin')
      <li class="nav-item nav-category"><span class="nav-link">Configurations</span></li>
      <li class="nav-item {{ Route::currentRouteName() == 'centers.index' ? 'active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#centers" aria-expanded="false" aria-controls="centers">
          <span class="menu-title">Centres</span>
          <i class="icon-home menu-icon"></i>
        </a>
        <div class="collapse" id="centers">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="#"> Ajouter </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('centers.index') }}"> Liste </a></li>
          </ul>
        </div>
      </li>
      @hasanyrole('admin|super-admin')
        <li class="nav-item {{ Route::currentRouteName() == 'users.index' ? 'active' : '' }}">
          <a class="nav-link" data-toggle="collapse" href="#users" aria-expanded="false" aria-controls="users">
            <span class="menu-title">Utilisateurs</span>
            <i class="icon-user menu-icon"></i>
          </a>
          <div class="collapse" id="users">
            <ul class="nav flex-column sub-menu">
              <!-- <li class="nav-item"> <a class="nav-link" href="#">Ajouter</a></li> -->
              <li class="nav-item"> <a class="nav-link" href="{{ route('users.index') }}">Liste</a></li>
            </ul>
          </div>
        </li>
      @endif
      <li class="nav-item {{ Route::currentRouteName() == 'clients.index' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('clients.index') }}">
          <span class="menu-title">Clients</span>
          <i class="icon-people menu-icon"></i>
        </a>
      </li>
    @endrole
  </ul>
</nav>