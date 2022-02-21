<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  <div class="navbar-brand-wrapper d-flex align-items-center">
    <a class="navbar-brand brand-logo" href="{{ route('home') }}">
      <span class="text-white font-weight-bold">E-visa Cameroun</span>
    </a>
    <a class="navbar-brand brand-logo-mini" href="{{ route('home') }}"><img src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/images/logo-mini.svg') }}" alt="logo" /></a>
  </div>
  <div class="navbar-menu-wrapper d-flex align-items-center flex-grow-1">
    <h5 class="mb-0 font-weight-medium d-none d-lg-flex"></h5>
    <ul class="navbar-nav navbar-nav-right ml-auto">
      <!-- <form class="search-form d-none d-md-block" action="#">
        <i class="icon-magnifier"></i>
        <input type="search" class="form-control" placeholder="Recherche" title="Recherche">
      </form>
      <li class="nav-item"><a href="#" class="nav-link"><i class="icon-chart"></i></a></li> -->
      <li class="nav-item dropdown d-none d-xl-inline-flex user-dropdown">
        <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
          <i class="fas {{ Auth::user()->sex == 'M' ? 'fa-male' : 'fa-female' }} user text-primary"></i> 
          <span class="font-weight-normal"> {{ Auth::user()->surname }} {{ Auth::user()->name }} </span></a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
          <div class="dropdown-header text-center">
            <i class="fas {{ Auth::user()->sex == 'M' ? 'fa-male' : 'fa-female' }} text-primary fa-3x"></i>
            <p class="mb-1 mt-3">{{ Auth::user()->surname }} {{ Auth::user()->name }}</p>
            <p class="font-weight-light text-muted mb-0">{{ Auth::user()->email }}</p>
          </div>
          <a class="dropdown-item"><i class="dropdown-item-icon icon-user text-primary"></i> Profil</a>
          <a class="dropdown-item"><i class="dropdown-item-icon icon-speech text-primary"></i> Messages</a>
          <a class="dropdown-item"><i class="dropdown-item-icon icon-energy text-primary"></i> Activités</a>
          <!-- <a class="dropdown-item"><i class="dropdown-item-icon icon-power text-primary"></i>Déconnexion</a> -->
          <form method="POST" action="{{ route('logout') }}">
              @csrf
              <a class="dropdown-item" href="{{ route('logout') }}"
                  onclick="event.preventDefault();
                  this.closest('form').submit();">
                  <i class="dropdown-item-icon icon-power text-primary"></i>
                  Se déconnecter
              <a>
          </form>
        </div>
      </li>
    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
      <span class="icon-menu"></span>
    </button>
  </div>
</nav>

@if ($message = Session::get('success'))
    <script>
        toastr.options.timeOut = 6000;
        toastr.options.positionClass = 'middle'
        toastr.success("{{ $message }}");
    </script>
@endif

@if ($message = Session::get('error'))
    <script>
        toastr.options.timeOut = 6000;
        toastr.options.positionClass = 'middle'
        toastr.error("{{ $message }}");
    </script>
@endif