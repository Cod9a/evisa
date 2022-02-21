@extends('front.layouts.front')

@section('title', 'Paiement')

@section('extra-meta')
	<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('customStyles')
	<script type="text/javascript" src="https://js.stripe.com/v3/"></script>
@endsection

@section('content')
	<div id="payment" class="container px-5 page" style="margin-top: 5em">
		<div class="row">
			<div class="col-12">
				<h1>Paiement</h1>
				<div class="row">
					<div class="col-lg-6">
						<p>Pour finaliser votre demande, vous devez régler la somme de {{ getTypeVisaPrice($dossier['type_visa_id']) }} F</p>
					</div>
				</div>
			</div>
		</div>

		<div class="row payment">
			<div class="col-lg-6 mb-4">
				<form action="{{ route('payment.store') }}" class="my-4" method="POST" id="payment-form">
					@csrf
					<div id="card-element">
					</div>

					<div id="card-errors" role="alert">
					</div>

					<button id="submit" class="btn btn-primary mt-4">
						Procéder au paiement des {{ getTypeVisaPrice($dossier['type_visa_id']) }} F
					</button>
				</form>
				
				{{-- <form role="form" action="{{ route('stripe.post') }}" method="post" class="require-validation mt-4"data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
                    @csrf
                    <input autocomplete='off' class='form-control card-number' type='text' name="card_number" placeholder="1234 1234 1234 1234">
                    <div class="smallInfos">
	                    <input class='form-control card-expiry-month' placeholder='MM' type='text' name="mm">
	                    <input class='form-control card-expiry-year' placeholder='YY' type='text' name="yy">
                    	<input autocomplete='off' class='form-control card-cvc' placeholder='CVC' type='text' name="cvc">
                    </div>
                    
                    <div class="form-group mt-4">
	                    <button class="btn btn-primary btn-block" type="submit">Payer</button>
	                </div>
                </form> --}}
			</div>

			<div class="col-lg-6 d-flex justify-content-center align-items-center">
				<img src="{{ asset((!\App::environment('local') ? 'public/' : '') . 'storage/front/assets/img/visas.png') }}" style="width: 40%; height: 80px; object-fit: contain;">
			</div>
		</div>
	</div>
@endsection

@section('customScripts')
	<script type="text/javascript">
		let stripe = Stripe('pk_test_51J0q6GA8e7XVSZ9orsWz93AzcruGR168dwJUScDHpMFj79wQsAhvQtjSdvtiyCsGTGvyDIjfbXqRhsE3Wswzr9VL00qPZY6Pv2')
		let elements = stripe.elements()
		var style = {
			base: {
				color: "#32325d",
				fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
				fontSmoothing: 'antialiased',
				fontSize: '16px',
				"::placeholder": {
					color: "#aab7c4"
				}
			},
			invalid: {
				color: "#fa755a",
				iconColor: "#fa755a",
			}
		}

		let card = elements.create("card", { hidePostalCode: true, style: style })
		card.mount("#card-element")

		card.addEventListener('change', ({error}) => {
			const displayError = document.getElementById('card-errors')
			if(error) {
				displayError.classList.add('alert', 'alert-warning')
				displayError.textContent = error.message
			} else {
				displayError.classList.remove('alert', 'alert-warning')
				displayError.textContent = ''
			}
		})

		let submitButton = document.getElementById('submit')
		submitButton.addEventListener('click', function(ev) {
			ev.preventDefault()
			submitButton.disabled = true
			stripe.confirmCardPayment("{{ $clientSecret }}", {
				payment_method: {
					card: card,
					// billing_details: {
					// 	name: "John DOE"
					// }
				}
			}).then(function(result) {
				if(result.error) {
					submitButton.disabled = false
					console.log(result.error.message)
				} else {
					if(result.paymentIntent.status === "succeeded") {
						let paymentIntent = result.paymentIntent
						console.log(paymentIntent)
						let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content')
						let form = document.getElementById('payment-form')
						let url = form.action
						let redirect = '/paiement-effectue'

						fetch(
							url,
							{
								headers: {
			                        "Content-Type": "application/json",
			                        "Accept": "application/json, text-plain, */*",
			                        "X-Requested-With": "XMLHttpRequest",
			                        "X-CSRF-TOKEN": token
			                    },
								method: 'post',
								body: JSON.stringify({
									paymentIntent: paymentIntent
								})
							}
						).then((data) => {
							console.log(data)
							window.location.href = redirect
						}).catch((error) => {
							console.log(error)
						})
					}
				}
			})
		})
	</script>
@endsection