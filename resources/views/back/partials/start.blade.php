<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title') &bull; E-visa</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/vendors/simple-line-icons/css/simple-line-icons.css') }}">
    <link rel="stylesheet" href="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/vendors/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/vendors/chartist/chartist.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/css/custom.css') }}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/images/favicon.png') }}">

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

    <!-- Toastr -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    @yield('customStyles')
  </head>