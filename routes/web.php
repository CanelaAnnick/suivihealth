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
use App\Http\Controllers\MedecinPatientController;
use App\Http\Controllers\MedecinOrdonnanceController;
use App\Http\Controllers\AdminPaiementController;
use App\Http\Controllers\UrgenceController;
use App\Http\Controllers\SuperAdminStatistiquesController;
use App\Http\Controllers\PatientPlainteController;
use App\Http\Controllers\AdminPlainteController;
use App\Http\Controllers\AdminMedecinController;
use App\Http\Controllers\AdminPatientController;
use App\Http\Controllers\SuperAdminHopitalController;
use App\Http\Controllers\SuperAdminAdminController;
use App\Http\Controllers\ProfilePhotoController;
use App\Http\Controllers\LangueController;
use App\Http\Controllers\VaccinationController;
use App\Http\Controllers\ProfileController;




Route::post('/langue/{locale}', [LangueController::class, 'switch'])->name('langue.switch');

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

    Route::get('/dossier-medical/export', [DossierMedicalController::class, 'exportPdf'])->name('dossier.export');

    Route::get('/urgence', [UrgenceController::class, 'index'])->name('urgence');

    Route::get('/consultation/{rdv}/reprogrammer', [RendezVousController::class, 'reprogrammer'])->name('consultation.reprogrammer');
    Route::post('/consultation/{rdv}/reprogrammer', [RendezVousController::class, 'storeReprogrammation'])->name('consultation.reprogrammer.store');

    Route::get('/plaintes', [PatientPlainteController::class, 'index'])->name('plaintes.index');
    Route::post('/plaintes', [PatientPlainteController::class, 'store'])->name('plaintes.store');

    Route::delete('/dossier-medical/{symptome}', [DossierMedicalController::class, 'destroySymptome'])->name('dossier.destroy');
    Route::delete('/constantes/{constante}', [ConstanteController::class, 'destroy'])->name('constantes.destroy');

    Route::post('/vaccinations', [VaccinationController::class, 'store'])->name('vaccinations.store');
    Route::delete('/vaccinations/{vaccination}', [VaccinationController::class, 'destroy'])->name('vaccinations.destroy');
    Route::patch('/dossier-medical/allergies', [DossierMedicalController::class, 'updateAllergies'])->name('dossier.allergies');
    Route::get('/carnet-sante', [DossierMedicalController::class, 'exportCarnet'])->name('carnet.export');  
});

Route::middleware(['auth', 'role:medecin'])->prefix('medecin')->name('medecin.')->group(function () {
    Route::get('/dashboard', [MedecinDashboardController::class, 'index'])->name('dashboard');

    Route::get('/patients', [MedecinPatientController::class, 'index'])->name('patients');
    Route::get('/patients/{patient}', [MedecinPatientController::class, 'show'])->name('patients.show');

    Route::get('/rendez-vous', [MedecinRendezVousController::class, 'index'])->name('rendezvous');
    Route::get('/rendez-vous/demandes', [MedecinRendezVousController::class, 'demandesEnAttente'])->name('rendezvous.demandes');
    Route::post('/rendez-vous/{rdv}/accepter', [MedecinRendezVousController::class, 'accepter'])->name('rendezvous.accepter');
    Route::post('/rendez-vous/{rdv}/refuser', [MedecinRendezVousController::class, 'refuser'])->name('rendezvous.refuser');

    Route::get('/ordonnances', [MedecinOrdonnanceController::class, 'index'])->name('ordonnances');
    Route::get('/patients/{patient}/ordonnance', [MedecinOrdonnanceController::class, 'create'])->name('ordonnances.create');
    Route::post('/patients/{patient}/ordonnance', [MedecinOrdonnanceController::class, 'store'])->name('ordonnances.store');

    Route::patch('/disponibilite', [MedecinDashboardController::class, 'toggleDisponibilite'])->name('disponibilite.toggle');
    Route::delete('/rendez-vous/{rdv}/historique', [MedecinRendezVousController::class, 'destroyHistorique'])->name('rendezvous.destroy');
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('/medecins', [AdminMedecinController::class, 'index'])->name('medecins.index');
    Route::get('/medecins/creer', [AdminMedecinController::class, 'create'])->name('medecins.create');
    Route::post('/medecins', [AdminMedecinController::class, 'store'])->name('medecins.store');
    Route::patch('/medecins/{medecin}/statut', [AdminMedecinController::class, 'toggleStatut'])->name('medecins.toggle');

    Route::get('/patients', [AdminPatientController::class, 'index'])->name('patients.index');
    Route::get('/patients/{patient}', [AdminPatientController::class, 'show'])->name('patients.show');

    Route::get('/statistiques', [AdminDashboardController::class, 'statistiques'])->name('statistiques');
    Route::get('/paiements', [AdminPaiementController::class, 'index'])->name('paiements.index');

    Route::get('/plaintes', [AdminPlainteController::class, 'index'])->name('plaintes.index');
    Route::patch('/plaintes/{plainte}', [AdminPlainteController::class, 'update'])->name('plaintes.update');

    Route::delete('/medecins/{medecin}', [AdminMedecinController::class, 'destroy'])->name('medecins.destroy');
    Route::get('/patients/{patient}/export', [AdminPatientController::class, 'exportPdf'])->name('patients.export');
});

Route::middleware(['auth', 'role:superadmin'])->prefix('superadmin')->name('superadmin.')->group(function () {
    Route::get('/dashboard', [SuperAdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('/hopitaux', [SuperAdminHopitalController::class, 'index'])->name('hopitaux.index');
    Route::get('/hopitaux/creer', [SuperAdminHopitalController::class, 'create'])->name('hopitaux.create');
    Route::post('/hopitaux', [SuperAdminHopitalController::class, 'store'])->name('hopitaux.store');
    Route::get('/administrateurs', [SuperAdminAdminController::class, 'index'])->name('admins.index');
    Route::get('/administrateurs/creer', [SuperAdminAdminController::class, 'create'])->name('admins.create');
    Route::post('/administrateurs', [SuperAdminAdminController::class, 'store'])->name('admins.store');
    Route::patch('/administrateurs/{admin}/statut', [SuperAdminAdminController::class, 'toggleActif'])->name('admins.toggle');
    Route::delete('/administrateurs/{admin}', [SuperAdminAdminController::class, 'destroy'])->name('admins.destroy');
    Route::get('/statistiques', [AdminDashboardController::class, 'statistiques'])->name('statistiques');
    Route::get('/statistiques', [SuperAdminStatistiquesController::class, 'index'])->name('statistiques');
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

    Route::get('/salle/{rdv}/statut', [ConsultationSalleController::class, 'statut'])->name('salle.statut');
    Route::get('/salle/{rdv}/attente', function (\App\Models\RendezVous $rdv) {
        abort_if(auth()->user()->patient?->id !== $rdv->patient_id, 403);
        return view('salle.attente', compact('rdv'));
    })->name('salle.attente');

    Route::post('/salle/{rdv}/terminer', [ConsultationSalleController::class, 'terminer'])->name('salle.terminer');

    Route::delete('/notifications/{notification}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
    Route::delete('/notifications/lues', [NotificationController::class, 'destroyToutLu'])->name('notifications.destroy-lues');
    Route::post('/profil/photo', [ProfilePhotoController::class, 'update'])->name('profil.photo');
});

require __DIR__.'/auth.php';
