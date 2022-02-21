@include('back.partials.start')
<body>
	<div class="container-scroller">
		@include('back.partials.nav')
		<div class="container-fluid page-body-wrapper">
			@include('back.partials.sidebar')
			<div class="main-panel">
				<div class="content-wrapper" style="margin-top: 4em">
					@include('back.partials.breadcrumb')
					@yield('content')
				</div>
				@include('back.partials.footer')
			</div>
		</div>
	</div>
	@include('back.partials.end')
</body>
</html>

