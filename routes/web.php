<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\CenterController;
use App\Http\Controllers\DossierController;
use App\Http\Controllers\StripeController;

// Route::get('/a', [MainController::class, 'a'])->name('a');

//Front's routes
Route::get('/', [MainController::class, 'index'])->name('index');
Route::get('/demande-de-visa', [HomeController::class, 'applyForVisa'])->name('applyForVisa');
Route::get('/prendre-un-rendez-vous', [MainController::class, 'takeRDV'])->name('takeRDV');
Route::get('/statut-de-votre-demande', [HomeController::class, 'applyStatus'])->name('applyStatus');
Route::get('/contact', [MainController::class, 'contact'])->name('contact');

Auth::routes();
Route::get('confirmation-inscription/{user_id}/{token}', [MainController::class, 'registrationConfirmation'])->name('registrationConfirmation');
Route::get('/confirmez-votre-inscription', [MainController::class, 'registrationToConfirmation'])->name('registrationToConfirmation');

Route::get('paiement/{dossier_id}/{token}', [HomeController::class, 'payment'])->name('payment');
Route::post('paiement', [HomeController::class, 'paymentStore'])->name('payment.store');
Route::get('/paiement-effectue', [HomeController::class, 'paymentApplied'])->name('payment.applied');

Route::get('/home', [HomeController::class, 'home'])->name('home');

//Demande de visa
Route::get('/home/apply', [HomeController::class, 'apply'])->name('apply');
Route::post('/home/apply', [HomeController::class, 'applySubmit'])->name('apply.submit');

//Paiment
Route::get('/home/paid', [HomeController::class, 'paid'])->name('paid');
Route::post('/home/paid', [HomeController::class, 'paidSubmit'])->name('paid.submit');

//Centres de traitement
Route::get('/home/centers', [CenterController::class, 'index'])->name('centers.index');

//Liste des clients
Route::get('/home/clients', [HomeController::class, 'clients'])->name('clients.index');

//Gestion des agents
Route::get('/home/agents', [UserController::class, 'indexAgent'])->name('agents.index');

//Gestion des administrateurs
Route::get('/home/users/{role?}', [UserController::class, 'index'])->name('users.index');
Route::get('/home/users/create/{role}', [UserController::class, 'create'])->name('users.create');
Route::post('/home/users/store/{role}', [UserController::class, 'store'])->name('users.store');

//Gestion des dossiers
Route::get('/home/dossiers/{state?}', [DossierController::class, 'index'])->name('dossiers.index');

Route::post('/home/dossiers/{dossier}', [DossierController::class, 'finalised'])->name('dossiers.finalised');

Route::get('/home/dossiers/show/{dossier}/{token}', [DossierController::class, 'show'])->name('dossiers.show');

Route::get('/home/dossiers/rejected/{dossier}', [DossierController::class, 'setRejected'])->name('dossiers.setRejected');
Route::get('/home/dossiers/validated/{dossier}', [DossierController::class, 'setValidated'])->name('dossiers.setValidated');

Route::get('/home/dossiers/validatedFiles/{file}/{dossier}/{token}', [DossierController::class, 'validatedFiles'])->name('dossiers.validatedFiles');

Route::get('/home/dossiers/setState/{dossier}/{state}/{token}', [DossierController::class, 'setState'])->name('dossiers.setState');

