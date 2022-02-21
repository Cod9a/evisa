<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Inscription &bull; E-visa Cameroun</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/vendors/simple-line-icons/css/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/css/style.css') }}">
    <link rel="shortcut icon" href="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/images/favicon.png') }}">
    <style type="text/css">
      .guestForm .text-danger {
        font-size: 14px;
      }
    </style>
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left p-5">
                <div class="brand-logo text-center">
                  <b>E-visa Cameroun</b>
                </div>
                <h4>Inscrivez-vous en un rien de temps</h4>
                <!-- <h6 class="font-weight-light">Inscrivez-vous en un rien de temps</h6> -->
                <form class="guestForm pt-3" method="post" action="{{ route('register') }}">
                  @csrf
                  <div class="form-group">
                    <input type="text" placeholder="Votre nom" required autofocus name="name" class="form-control form-control-lg @error('name') is-invalid @enderror" value="{{ old('name') }}">
                    @error('name')
                        <p class="text-danger" role="alert">
                            {{ $message }}
                        </p>
                    @enderror
                  </div>

                  <div class="form-group">
                    <input type="text" placeholder="Votre prénom" required name="surname" class="form-control form-control-lg @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}">
                    @error('surname')
                        <p class="text-danger" role="alert">
                            {{ $message }}
                        </p>
                    @enderror
                  </div>

                  <div class="form-group">
                    <input type="email" placeholder="Votre adresse email" required class="form-control form-control-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}">
                    @error('email')
                        <p class="text-danger" role="alert">
                            {{ $message }}
                        </p>
                    @enderror
                  </div>
                  <div class="form-group">
                    <select name="country" required class="form-control form-control-lg @error('email') is-invalid @enderror">
                      <option default hidden>-- Sélectionner votre pays de résidence --</option>
                      @foreach(getCountries() as $country)
                        <option value="{{ $country->code }}" {{ old('country') == $country->code ? 'selected' : '' }}>{{ $country->name }}</option>
                      @endforeach
                    </select>
                    @error('country')
                        <p class="text-danger" role="alert">
                            {{ $message }}
                        </p>
                    @enderror
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control form-control-lg" placeholder="Mot de passe" name="password" required autocomplete="new-password">
                    @error('password')
                        <p class="text-danger" role="alert">
                            {{ $message }}
                        </p>
                    @enderror
                  </div>
                  <div class="form-group">
                    <input type="password" class="form-control form-control-lg" placeholder="Confirmez le mot de passe" name="password_confirmation" required autocomplete="new-password">
                  </div>
                  <div class="mt-3">
                    <input type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" value="S'inscrire">
                  </div>
                  <div class="text-center mt-4 font-weight-light"> Vous avez un compte? <a href="{{ route('login') }}" class="text-primary">Connectez-vous</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/js/off-canvas.js') }}"></script>
    <script src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/js/misc.js') }}"></script>
  </body>
</html>