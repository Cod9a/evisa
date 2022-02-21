<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class MainController extends Controller
{
    public function index() {
        return view('front.index');
    }

    public function contact() {
        return view('front.pages.contact');
    }

    public function registrationToConfirmation() {
        return Session::has('success') ? view('front.pages.registrationToConfirmation') : redirect()->route('login');
    }

    public function registrationConfirmation($user_id, $token) {
        $user = User::find($user_id);

        if($user->token === null) {
            Session::flash('error', "Vous avez déjà confirmé votre inscription.");
            return redirect()->route('login');
        }

        if($user->token === $token) {
            $user->update([
                $user->token = null
            ]);
            Session::flash('success', "Inscription confirmée avec succès.");
            return redirect()->route('login');
        } else {
            abort(403);
        }
    }

    public function a() {
        return view('back.pages.dossiers.attestation');
    }
}
