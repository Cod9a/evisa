<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ApplyRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use App\Models\Center;
use App\Models\Dossier;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\DossierCreateMail;
use App\Mail\PaymentReceivedMail;
use Illuminate\Support\Str;
use Cookie;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Illuminate\Support\Arr;
use Carbon\Carbon;

class HomeController extends Controller
{    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home() {
        return view('back.home');
    }

    // public function apply() {
    //     return view('back.pages.apply');
    // }

    public function applyForVisa() {
        return view('front.pages.applyForVisa');
    }

    public function applyStatus() {
        $dossiers = Dossier::whereUserId(Auth::id())->wherePaid(true)->orderBy('id', 'desc')->get();
        return view('front.pages.applyStatus', compact('dossiers'));
    }

    public function applySubmit(ApplyRequest $request) {
        $occur = Dossier::whereUserId(Auth::id())->whereState('10')->wherePaid(true)->exists();
        if($occur) {
            Session::flash('error', "Vous avez déjà un dossier en cours de traitement.");
            return redirect()->route('index');
        }

        if ($request->hasFile('passport')) {
            $urlPassport = null;
            $urlTicket = null;
            $urlAccommodation = null;
            $urlWork = null;
            $urlMission = null;
            $urlImposition = null;
            $urlHotel = null;

            if ($request->file('passport')->isValid()) {
                $extension = $request->passport->extension();
                $name = "EV-" . uniqid() . "." . $extension;
                $urlPassport = 'back/documents/' . $name;
                Storage::disk('documents')->put($name, File::get($request->file('passport')));
            }

            if ($request->file('ticket')) {
                $extension = $request->ticket->extension();
                $name = "EV-" . uniqid() . "." . $extension;
                $urlTicket = 'back/documents/' . $name;
                Storage::disk('documents')->put($name, File::get($request->file('ticket')));
            }

            if ($request->file('accommodation')) {
                $extension = $request->accommodation->extension();
                $name = "EV-" . uniqid() . "." . $extension;
                $urlAccommodation = 'back/documents/' . $name;
                Storage::disk('documents')->put($name, File::get($request->file('accommodation')));
            }

            if ($request->file('work')) {
                $extension = $request->work->extension();
                $name = "EV-" . uniqid() . "." . $extension;
                $urlWork = 'back/documents/' . $name;
                Storage::disk('documents')->put($name, File::get($request->file('work')));
            }

            if ($request->file('mission')) {
                $extension = $request->mission->extension();
                $name = "EV-" . uniqid() . "." . $extension;
                $urlMission = 'back/documents/' . $name;
                Storage::disk('documents')->put($name, File::get($request->file('mission')));
            }

            if ($request->file('imposition')) {
                $extension = $request->imposition->extension();
                $name = "EV-" . uniqid() . "." . $extension;
                $urlImposition = 'back/documents/' . $name;
                Storage::disk('documents')->put($name, File::get($request->file('imposition')));
            }

            if ($request->file('hotel')) {
                $extension = $request->hotel->extension();
                $name = "EV-" . uniqid() . "." . $extension;
                $urlHotel = 'back/documents/' . $name;
                Storage::disk('documents')->put($name, File::get($request->file('hotel')));
            }

            $center = Center::where('countries_for', 'like', '%' . $request['provenance'] . '%')->first();
            
            if(!$center) {
                Session::flash('error', "Une erreur s'est produite.");
                return redirect()->route('index');
            }

            $dossier = Dossier::create([
               'type_visa_id' => $request['type_visa'],
               'user_id' => Auth::id(),
               'center_id' => $center->id,
               'provenance' => $request['provenance'],
               'paid' => false, 
               'passport_num' => $request['passport_num'],
               'passport_type' => $request['passport_type'],
               'passport_expiration' => $request['passport_expiration'],
               'passport' => $urlPassport,
               'work' => $urlWork,
               'mission' => $urlMission,
               'accommodation' => $urlAccommodation,
               'hotel' => $urlHotel,
               'ticket' => $urlTicket,
               'imposition' => $urlImposition,
               'motif' => $request['motif'],
               'token' => (string) Str::uuid()
            ]);

            Cookie::queue('dossier', $dossier, 60);

            // Mail::to(Auth::user()->email)->send(new DossierCreateMail($dossier));

            Session::flash('success', "Procédez maintenant au paiement.");
                return redirect()->route('payment', ['dossier_id' => $dossier->id, 'token' => $dossier->token]);
        }
        abort(500, 'Problème avec l\'image');
    }

    public function clients()
    {
        $clients = User::role('client')->paginate(5);
        return view('back.pages.clients.index', compact('clients'));
    }

    public function payment($dossier_id, $token) {
        if(!\Request::cookie('dossier')) {
            Session::flash('error', "Opération pas possible.");
            return redirect()->route('index');
        }

        // if(is_connected() == false) {
        //     Session::flash('error', "Vérifiez votre connexion svp !");
        //     return redirect()->route('index');
        // }

        $dossier = json_decode(\Request::cookie('dossier'), true);

        $baseDos = Dossier::find($dossier['id']);

        if($baseDos->token === $token) {
            $clientSecret = null;
            Stripe::setApiKey(env('STRIPE_SECRET'));
            $intent = PaymentIntent::create([
                "amount" => getTypeVisaPrice($dossier['type_visa_id']),
                "currency" => "xaf",
                'metadata' => [
                    'integration_check' => 'accept_a_payment',
                    'userId' => Auth::id()
                ],
            ]);
            $clientSecret = Arr::get($intent, 'client_secret');
            return view('front.pages.payment', compact('clientSecret', 'dossier'));
        } else {
            abort('403');
        }
    }

    public function paymentStore(Request $request) {
        if(!\Request::cookie('dossier'))
            return redirect()->route('index');

        $data = $request->json()->all();

        $dossier = json_decode(\Request::cookie('dossier'), true);
        $baseDos = Dossier::find($dossier['id']);

        $state = ['status' => 10, 'created_at' => date('Y/m/d H:i:s')];

        $baseDos->update([
            'paid' => true,
            'state' => "10*" . date('d-m-Y H:i:s'),
            'transaction_id' => $data['paymentIntent']['payment_method'],
            'transaction_status' => 'success',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        $send = [
            'amount' => $data['paymentIntent']['amount'],
            'transactionID' => $data['paymentIntent']['payment_method'],
            'numDos' => "EVISA-CAM" . str_pad($dossier['id'], 8, "0", STR_PAD_LEFT),
            'created' => Carbon::parse($data['paymentIntent']['created'])->format('d/m/Y H:i'),
            'center' => $baseDos->center->name,
            'name' => $baseDos->user->surname . ' ' . $baseDos->user->name
        ];

        Cookie::queue('dossier', 0, 60);
        Session::flash('success', "Paiement effectué avec succès.");

        $subject = 'Paiement effectué avec succès.';
        $from = 'evisacameroun@evisacameroun.com';
        Mail::send(['text' => 'emails.dossiers.paid2', 'html' => 'emails.dossiers.paid2'], $send, function ($message) use ($subject, $from) {
            $message->to(Auth::user()->email, 'Paiement effectué avec succès.')
            ->subject($subject)
            ->from($from);
            // ->setBody($html, 'text/html');
        });

        return $data['paymentIntent'];
    }

    public function paymentApplied() {
        // return view('front.pages.applied');
        return Session::has('success') ? view('front.pages.applied') : redirect()->route('applyStatus');
    }
}
