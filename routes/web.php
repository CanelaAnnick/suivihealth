<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PatientDashboardController;
use App\Http\Controllers\DossierMedicalController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\RendezVousController;

// routes/web.php
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');


Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/a-propos', [PageController::class, 'apropos'])->name('apropos');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth', 'role:patient'])->prefix('patient')->name('patient.')->group(function () {
    Route::get('/dashboard', [PatientDashboardController::class, 'index'])->name('dashboard');

    Route::get('/dossier-medical', [DossierMedicalController::class, 'index'])->name('dossier.index');
    Route::post('/dossier-medical', [DossierMedicalController::class, 'store'])->name('dossier.store');

    Route::get('/consultation', [ConsultationController::class, 'choix'])->name('consultation.choix');
    Route::get('/consultation/generalistes', [ConsultationController::class, 'generalistes'])->name('consultation.generalistes');
    Route::get('/consultation/specialites', [ConsultationController::class, 'specialites'])->name('consultation.specialites');
    Route::get('/consultation/medecins', [ConsultationController::class, 'medecinsParSpecialite'])->name('consultation.medecins');

    Route::get('/consultation/medecin/{medecin}/mode', [RendezVousController::class, 'choixMode'])->name('consultation.mode');
    Route::post('/consultation/medecin/{medecin}/consulter', [RendezVousController::class, 'consulterMaintenant'])->name('consultation.consulter');
    
    Route::get('/consultation/medecin/{medecin}/rdv', [RendezVousController::class, 'formulaireRdv'])->name('consultation.rdv.form');
    Route::post('/consultation/medecin/{medecin}/rdv', [RendezVousController::class, 'storeRdv'])->name('consultation.rdv.store');
    
    Route::get('/consultation/paiement/{rdv}', [RendezVousController::class, 'paiement'])->name('consultation.paiement');
    Route::post('/consultation/paiement/{rdv}', [RendezVousController::class, 'confirmerPaiement'])->name('consultation.paiement.confirmer');
    Route::get('/consultation/confirmation/{rdv}', [RendezVousController::class, 'confirmation'])->name('consultation.confirmation');
});

Route::middleware(['auth', 'role:medecin'])->prefix('medecin')->name('medecin.')->group(function () {
    Route::get('/dashboard', fn () => view('dashboards.medecin'))->name('dashboard');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', fn () => view('dashboards.admin'))->name('dashboard');
});

Route::middleware(['auth', 'role:superadmin'])->prefix('superadmin')->name('superadmin.')->group(function () {
    Route::get('/dashboard', fn () => view('dashboards.superadmin'))->name('dashboard');
});

require __DIR__.'/auth.php';
