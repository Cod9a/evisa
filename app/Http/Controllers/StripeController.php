<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
    
class StripeController extends Controller {

    public function __construct(){
        $this->middleware('auth');
    }

    public function stripe() {
        $clientSecret = null;
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $intent = PaymentIntent::create([
            "amount" => 10000,
            "currency" => "xaf",
            'metadata' => [
                'integration_check' => 'accept_a_payment',
                'userId' => Auth::id()
            ],
        ]);

        $clientSecret = Arr::get($intent, 'client_secret');
        return view('front.pages.payment', compact('clientSecret'));
    }

    public function stripePost(Request $request) {
        dd($request);
        Stripe\Charge::create ([
                "amount" => 100 * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "This payment is tested purpose phpcodingstuff.com"
        ]);
   
        Session::flash('success', 'Payment successful!');
           
        return back();
    }
}
