@extends('front.layouts.front')

@section('title', 'Contactez-nous')

@section('content')
	<div id="contact" class="container px-5 page" style="margin-top: 5em">
		<div class="row">
			<div class="col-12">
				<h1>Nous contacter</h1>
				<div class="row">
					<div class="col-lg-6">
						<p>Besoin d'assitance en ligne? Notre hotline reste disponible pour vous accompagner.</p>
					</div>
				</div>
			</div>
		</div>

		<div class="row contacts">
			<div class="col-lg-4">
				<div class="contact">
					<i class="far fa-envelope bg bg-primary text-white"></i>
					<a href="mailto:test@gmail.com">test@gmail.com</a>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="contact">
					<i class="fas fa-phone bg bg-primary text-white"></i>
					<a href="tel:+22545458574">+225 45 45 85 74</a>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="contact">
					<i class="fas fa-globe bg bg-primary text-white"></i>
					<a href="https://www.site.com" target="_blank">https://www.site.com</a>
				</div>
			</div>
		</div>
	</div>
@endsection