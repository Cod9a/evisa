<footer class="text-center py-5">
    <div class="container px-5">
        <div class="top">
            <img src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/front/assets/img/impact2.png') }}">
            <div class="text-white-50 small">
                <a href="{{ route('login') }}">Connexion</a>
                <span class="mx-1">&middot;</span>
                <a href="#!">Termes</a>
                <span class="mx-1">&middot;</span>
                <a href="#!">FAQ</a>
            </div>
        </div>
        
        <div class="mb-2" style="color: #ccc">&copy; {{ date('Y') }} E-visa Cameroun.</div>
    </div>
</footer>