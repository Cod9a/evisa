<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Connexion &bull; E-visa Cameroun</title>
    <link rel="stylesheet" href="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/vendors/simple-line-icons/css/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/css/style.css') }}">
    <link rel="shortcut icon" href="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/images/favicon.png') }}" />

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

    <!-- Toastr -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style type="text/css">
      .guestForm .text-danger {
        font-size: 12px;
      }
    </style>
  </head>
  <body>
    @if ($message = Session::get('success'))
        <script>
            toastr.options.timeOut = 6000;
            toastr.success("{{ $message }}");
        </script>
    @endif

    @if ($message = Session::get('error'))
        <script>
            toastr.options.timeOut = 6000;
            toastr.error("{{ $message }}");
        </script>
    @endif
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left p-5">
                <div class="brand-logo text-center">
                  <b>E-visa Cameroun</b>
                </div>
                <h4>Connectez-vous pour continuer</h4>
                <form class="guestForm pt-3" action="{{ route('login') }}" method="POST">
                  @csrf
                  <div class="form-group">
                    <input placeholder="Adresse email" id="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                  <div class="form-group">
                    <input type="password" placeholder="Mot de passe" id="password" type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    @error('password')
                        <span class="text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>
                  <div class="mt-3">
                    <input class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit" value="Se connecter">
                  </div>
                  <div class="my-2 d-flex justify-content-between align-items-center">
                    <div class="form-check">
                      <label class="form-check-label text-muted">
                        <input type="checkbox" class="form-check-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> Se rappeler de moi </label>
                    </div>
                    @if (Route::has('password.request'))
                        <a href="#" class="auth-link text-black">Mot de passe oublié?</a>
                    @endif
                  </div>
                  <!-- <div class="mb-2">
                    <button type="button" class="btn btn-block btn-facebook auth-form-btn">
                      <i class="icon-social-facebook mr-2"></i>Connexion avec Facebook </button>
                  </div> -->
                  <div class="text-center mt-4 font-weight-light"> Vous n'avez pas de compte? <a href="{{ route('register') }}" class="text-primary">Inscrivez-vous</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/js/off-canvas.js') }}"></script>
    <script src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/js/misc.js') }}"></script>
    <!-- endinject -->
  </body>
</html>