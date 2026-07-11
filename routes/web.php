<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\PatientDashboardController;
use App\Http\Controllers\DossierMedicalController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\RendezVousController;
use App\Http\Controllers\ConstanteController;
use App\Http\Controllers\OrdonnanceController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedecinDashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\SuperAdminDashboardController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PatientProfilController;
use App\Http\Controllers\ConsultationSalleController;
use App\Http\Controllers\MedecinRendezVousController;



Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/a-propos', [PageController::class, 'apropos'])->name('apropos');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');


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

    Route::post('/api/consultation/{medecin}/creer', [RendezVousController::class, 'apiCreerConsultation'])->name('api.consultation.creer');
    Route::post('/api/consultation/{medecin}/rdv', [RendezVousController::class, 'apiCreerRdv'])->name('api.consultation.rdv');
    Route::post('/api/consultation/{rdv}/payer', [RendezVousController::class, 'apiPayer'])->name('api.consultation.payer');

    Route::get('/consultation/medecin/{medecin}/mode', [RendezVousController::class, 'choixMode'])->name('consultation.mode');
    Route::post('/consultation/medecin/{medecin}/consulter', [RendezVousController::class, 'consulterMaintenant'])->name('consultation.consulter');
    
    Route::get('/consultation/medecin/{medecin}/rdv', [RendezVousController::class, 'formulaireRdv'])->name('consultation.rdv.form');
    Route::post('/consultation/medecin/{medecin}/rdv', [RendezVousController::class, 'storeRdv'])->name('consultation.rdv.store');
    
    Route::get('/consultation/paiement/{rdv}', [RendezVousController::class, 'paiement'])->name('consultation.paiement');
    Route::post('/consultation/paiement/{rdv}', [RendezVousController::class, 'confirmerPaiement'])->name('consultation.paiement.confirmer');
    Route::get('/consultation/confirmation/{rdv}', [RendezVousController::class, 'confirmation'])->name('consultation.confirmation');

    Route::get('/constantes', [ConstanteController::class, 'index'])->name('constantes.index');
    Route::post('/constantes', [ConstanteController::class, 'store'])->name('constantes.store');

    Route::get('/ordonnances', [OrdonnanceController::class, 'index'])->name('ordonnances.index');
    Route::get('/ordonnances/{ordonnance}/telecharger', [OrdonnanceController::class, 'telecharger'])->name('ordonnances.telecharger');
    Route::patch('/profil/infos', [PatientProfilController::class, 'update'])->name('profil.infos');
});

Route::middleware(['auth', 'role:medecin'])->prefix('medecin')->name('medecin.')->group(function () {
    Route::get('/dashboard', [MedecinDashboardController::class, 'index'])->name('dashboard');

    Route::get('/patients', fn () => view('dashboards.placeholder', ['title' => 'Mes patients', 'roleSidebar' => 'sidebar-medecin', 'active' => 'patients']))->name('patients');
    Route::get('/rendez-vous', [MedecinRendezVousController::class, 'index'])->name('rendezvous');
    Route::get('/ordonnances', fn () => view('dashboards.placeholder', ['title' => 'Ordonnances', 'roleSidebar' => 'sidebar-medecin', 'active' => 'ordonnances']))->name('ordonnances');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('/medecins', fn () => view('dashboards.placeholder', ['title' => 'Médecins', 'roleSidebar' => 'sidebar-admin', 'active' => 'medecins']))->name('medecins.index');
    Route::get('/patients', fn () => view('dashboards.placeholder', ['title' => 'Patients', 'roleSidebar' => 'sidebar-admin', 'active' => 'patients']))->name('patients.index');
    Route::get('/statistiques', fn () => view('dashboards.placeholder', ['title' => 'Statistiques', 'roleSidebar' => 'sidebar-admin', 'active' => 'stats']))->name('statistiques');
});

Route::middleware(['auth', 'role:superadmin'])->prefix('superadmin')->name('superadmin.')->group(function () {
    Route::get('/dashboard', [SuperAdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('/hopitaux', fn () => view('dashboards.placeholder', ['title' => 'Hôpitaux', 'roleSidebar' => 'sidebar-superadmin', 'active' => 'hopitaux']))->name('hopitaux.index');
    Route::get('/administrateurs', fn () => view('dashboards.placeholder', ['title' => 'Administrateurs', 'roleSidebar' => 'sidebar-superadmin', 'active' => 'admins']))->name('admins.index');
    Route::get('/statistiques', fn () => view('dashboards.placeholder', ['title' => 'Statistiques globales', 'roleSidebar' => 'sidebar-superadmin', 'active' => 'stats']))->name('statistiques');
});

Route::middleware('auth')->group(function () {
    
    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [App\Http\Controllers\ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{notification}/lu', [NotificationController::class, 'marquerLu'])->name('notifications.lu');
    Route::post('/notifications/tout-lu', [NotificationController::class, 'marquerToutLu'])->name('notifications.tout-lu');

    Route::get('/salle/{rdv}', [ConsultationSalleController::class, 'show'])->name('salle.show');
    Route::get('/salle/{rdv}/messages', [ConsultationSalleController::class, 'getMessages'])->name('salle.messages.index');
    Route::post('/salle/{rdv}/messages', [ConsultationSalleController::class, 'storeMessage'])->name('salle.messages.store');

});

require __DIR__.'/auth.php';
