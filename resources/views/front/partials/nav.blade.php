<nav class="navbar navbar-expand-lg navbar-light fixed-top shadow-sm" id="mainNav">
    <div class="container px-5">
        <a class="navbar-brand fw-bold" href="#page-top">E-visa Cameroun</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="bi-list"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto me-4 my-3 my-lg-0">
                <li class="nav-item"><a class="nav-link me-lg-3{{ Route::currentRouteName() == 'index' ? ' text-active' : '' }}" href="{{ route('index') }}">Accueil</a></li>
                <li class="nav-item"><a class="nav-link me-lg-3{{ Route::currentRouteName() == 'applyForVisa' ? ' text-active' : '' }}" href="{{ route('applyForVisa') }}">Faire une demande de visa</a></li>
                <li class="nav-item"><a class="nav-link me-lg-3{{ Route::currentRouteName() == 'applyStatus' ? ' text-active' : '' }}" href="{{ route('applyStatus') }}">Statut de votre demande</a></li>
                <li class="nav-item"><a class="nav-link me-lg-3{{ Route::currentRouteName() == 'contact' ? ' text-active' : '' }}" href="{{ route('contact') }}">Contact</a></li>
            </ul>

            @if(!Auth::check())
                <a class="btn btn-primary rounded-pill px-3 mb-2 mb-lg-0" href="{{ route('login') }}">
                    <span class="d-flex align-items-center">
                        <i class="bi-chat-text-fill me-2"></i>
                        <span class="small">Connexion</span>
                    </span>
                </a>
            @else
                <a class="btn btn-primary rounded-pill px-3 mb-2 mb-lg-0" href="{{ route('home') }}">{{ getUserName(Auth::id()) }}</a>
            @endif
        </div>
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