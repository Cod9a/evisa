<?php

namespace App\Http\Controllers;

use App\Models\Dossier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use App\Mail\StateInfosMail;
use PDF;
use Illuminate\Support\Facades\DB;

class DossierController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($state = null) {
        if(!$state) {
            if(Auth::user()->hasRole('super-admin') || Auth::user()->hasRole('frontal-agent'))
                $dossiers = Dossier::where('state', '!=', '')->orderBy('id', 'desc')->paginate(10);
            elseif(Auth::user()->hasRole('client'))
                $dossiers = Dossier::where('state', '!=', '')->orderBy('id', 'desc')->where('user_id', Auth::id())->paginate(10);
            else
                $dossiers = Dossier::join('users', 'users.id', '=', 'dossiers.user_id')->where('users.center_id', 'dossiers.center_id')->orderBy('id', 'desc')->where('state', '!=', '')->paginate(10);
        } else {
            $length = 0;
            switch($state) {
                case 70: $length = 114; break;
                case 20: $length = 45; break;
                case 30: $length = 68; break;
                case 40: $length = 91; break;
                default: $length = 22;
            }

            if(Auth::user()->hasRole('super-admin') || Auth::user()->hasRole('frontal-agent'))
                $dossiers = Dossier::where(DB::raw('length(state)'), '=', $length)->orderBy('id', 'desc')->paginate(10);
            elseif(Auth::user()->hasRole('client'))
                $dossiers = Dossier::where('user_id', Auth::id())->where(DB::raw('length(state)'), '=', $length)->orderBy('id', 'desc')->paginate(10);
            else
                $dossiers = Dossier::join('users', 'users.id', '=', 'dossiers.user_id')->where(DB::raw('length(state)'), '=', $length)->where('users.center_id', 'dossiers.center_id')->orderBy('id', 'desc')->get();
        }
        
        return view('back.pages.dossiers.index', compact('dossiers', 'state'));
    }

    public function finalised(Request $request, Dossier $dossier) {
        $dossier->update([
            'finalisator_id' => Auth::id(),
            'state' => $dossier->state . ',40*' . date('d/m/Y H:i:s'),
            'expired_date' => $request['expired_date'],
            'delivered_date' => $request['delivered_date'],
            'visa_id' => $request['num_visa']
        ]);
        Session::flash('success', "Dossier finalisé avec succès.");
        $stateString = 'finalisé';
        $state = 40;
        Mail::to($dossier->user->email)->send(new StateInfosMail($dossier, $state, $stateString));

        return redirect()->route('dossiers.index');            
    }

    public function setRejected(Dossier $dossier) {
        if($dossier->paid == false) {
            Session::flash('error', "Paiement non effectué.");
            return back();
        }

        if($dossier->delivered_date) {
            Session::flash('error', "Ce dossier est déjà traité.");
            return back();
        }

        $dossier->update([
            'state' => 'Rejeté',
            'delivered_date' => date('Y-m-d')
        ]);
        Session::flash('success', "Demande rejeté avec success.");
        return redirect()->route('dossiers.index');
    }

    public function setValidated(Dossier $dossier) {
        if($dossier->paid == false) {
            Session::flash('error', "Paiement non effectué.");
            return back();
        }

        if($dossier->delivered_date) {
            Session::flash('error', "Ce dossier est déjà traité.");
            return back();
        }

        $dossier->update([
            'state' => 'Accepté',
            'duration' => 90,
            'delivered_date' => date('Y-m-d'),
            'visa_id' => '2100' . rand(1231,7879)
        ]);
        Session::flash('success', "Demande accepté avec success.");
        return redirect()->route('dossiers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dossier  $dossier
     * @return \Illuminate\Http\Response
     */
    public function show(Dossier $dossier) {
        return view('back.pages.dossiers.show', compact('dossier'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dossier  $dossier
     * @return \Illuminate\Http\Response
     */
    public function edit(Dossier $dossier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dossier  $dossier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dossier $dossier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dossier  $dossier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dossier $dossier)
    {
        //
    }

    public function paid(Request $request) {

        if($request['transaction-status'] == 'pending') {
            Session::flash('error', "Transaction non finalisé.");
            return back();
        }

        if($request['transaction-status'] == 'approved') {
            $dos = Dossier::find($request['dossier_id']);
            if($dos) {
                if($dos['paid'] == true) {
                    Session::flash('error', "Vous avez déjà payé.");
                    return back();
                }
                $dos->update([
                    'transaction_status' => 'approved',
                    'transaction_id' => $request['transaction-id'],
                    'state' => "En cours", 
                    'paid' => true 
                ]);
            }
            Session::flash('success', "Transaction effectuée avec succès.");
            return redirect()->route('dossiers.index');
        }
    }

    public function validatedFiles($file, Dossier $dossier) {
        $dossier->update([
            'validatedFiles' => $dossier->validatedFiles . ',' . $file
        ]);

        Session::flash('success', "Fichier validé avec succès.");
        return back();
    }

    public function setState(Dossier $dossier, $state) {
        $occur = 0;
        $stateString = '';

        if($state == 30) {
            if($dossier->validatedFiles)
                $validatedFiles = ltrim($dossier->validatedFiles, $dossier->validatedFiles[0]);
            else {
                Session::flash('error', "Vous n'avez validé aucun fichier.");
                return back();
            }
            $validatedFilesArrayLength = sizeof(explode(',', $validatedFiles));

            if($dossier->passport) ++$occur;
            if($dossier->ticket) ++$occur;
            if($dossier->accommodation) ++$occur;
            if($dossier->hotel) ++$occur;
            if($dossier->mission) ++$occur;
            if($dossier->work) ++$occur;
            if($dossier->imposition) ++$occur;

            // if($validatedFilesArrayLength === $occur) {
                $data = [
                    'dossier' => $dossier,
                ];
                $image = base64_encode(file_get_contents(public_path('storage/images/cameroun.png')));
                $pdf = PDF::loadView('back.pages.dossiers.attestation', $data);
                $name = "EV-" . uniqid() . ".pdf";
                Storage::disk('attestations')->put($name, $pdf->output());
                $dossier->update([
                    'controlor_id' => Auth::id(),
                    'state' => $dossier->state . ',30*' . date('d/m/Y H:i:s'),
                ]);
                Session::flash('success', "Dossier contrôlé avec succès.");
                $stateString = 'contrôlé';
            // } else {
            //     Session::flash('error', "Tous les fichiers concernés ne sont pas validés.");
            //     return back();
            // }
        } elseif($state == 20) {
            $dossier->update([
                'validator_id' => Auth::id(),
                'state' => $dossier->state . ',20*' . date('d/m/Y H:i:s'),
            ]);
            Session::flash('success', "Dossier validé avec succès.");
            $stateString = 'approuvé';
        } else {
            $dossier->update([
                'agent_id' => Auth::id(),
                'state' => $dossier->state . ',70*' . date('d/m/Y H:i:s')
            ]);
            Session::flash('success', "Dossier rejeté avec succès.");
            $stateString = 'rejeté';
        }

        Mail::to($dossier->user->email)->send(new StateInfosMail($dossier, $state, $stateString));

        return redirect()->route('index');
    }
}
