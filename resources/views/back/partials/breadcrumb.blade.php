<div class="page-header">
  <h3 class="page-title"> @yield('pageTitle') </h3>
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      @if(Route::currentRouteName() != "home")
        <li class="breadcrumb-item"><a href="{{ route('home') }}">Tableau de bord</a></li>
        <li class="breadcrumb-item active" aria-current="page">@yield('pageTitle')</li>
      @endif
    </ol>
  </nav>
</div>