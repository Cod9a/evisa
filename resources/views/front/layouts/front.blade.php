@include('front.partials.start')

@include('front.partials.nav')

@yield('content')

@if(Route::currentRouteName() != 'index')
	<div class="illustration">
		<img src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/front/assets/img/right-shape.svg') }}">
		<img src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/front/assets/img/right-shape.svg') }}">
	</div>
@endif

@include('front.partials.footer')

@include('front.partials.end')

</body>
</html>
