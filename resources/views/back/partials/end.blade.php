    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/vendors/moment/moment.min.js') }}"></script>
    <script src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/vendors/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/vendors/chartist/chartist.min.js') }}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/js/off-canvas.js') }}"></script>
    <script src="js/misc.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/js/dashboard.js') }}"></script>
    <!-- End custom js for this page -->

    @yield('customScripts')
  </body>
</html>