 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 <script src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/front/js/scripts.js') }}"></script>
 <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>

 @yield('customScripts')