<?php

namespace Database\Seeders;

use App\Models\Constante;
use App\Models\Hopital;
use App\Models\Medecin;
use App\Models\Notification;
use App\Models\Ordonnance;
use App\Models\Patient;
use App\Models\Plainte;
use App\Models\RendezVous;
use App\Models\Symptome;
use App\Models\User;
use App\Models\Vaccination;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ============ SUPER ADMIN ============
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@suivihealth.cm',
            'password' => Hash::make('password'),
            'role' => 'superadmin',
        ]);

        // ============ HÔPITAUX + ADMINS ============
        $hopitalDouala = Hopital::create([
            'nom' => 'Hôpital Laquintinie',
            'region' => 'Littoral',
            'adresse' => 'Akwa, Douala',
            'telephone' => '+237 233 42 12 34',
        ]);

        $adminDouala = User::create([
            'name' => 'Admin Laquintinie',
            'email' => 'admin@suivihealth.cm',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'hopital_id' => $hopitalDouala->id,
        ]);

        $hopitalYaounde = Hopital::create([
            'nom' => 'Hôpital Central de Yaoundé',
            'region' => 'Centre',
            'adresse' => 'Avenue Henri Dunant, Yaoundé',
            'telephone' => '+237 222 23 40 00',
        ]);

        $adminYaounde = User::create([
            'name' => 'Admin Central Yaoundé',
            'email' => 'admin2@suivihealth.cm',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'hopital_id' => $hopitalYaounde->id,
        ]);

        // ============ MÉDECINS ============
        $medecinsData = [
            ['name' => 'Dr. Jean Belinga', 'specialite' => 'Médecine générale', 'type' => 'generaliste', 'hopital' => $hopitalDouala, 'region' => 'Littoral', 'tarif' => 5000, 'dispo' => true],
            ['name' => 'Dr. Sophie Martin', 'specialite' => 'Médecine générale', 'type' => 'generaliste', 'hopital' => $hopitalDouala, 'region' => 'Littoral', 'tarif' => 5000, 'dispo' => true],
            ['name' => 'Dr. Marie Ngo', 'specialite' => 'Cardiologie', 'type' => 'specialiste', 'hopital' => $hopitalYaounde, 'region' => 'Centre', 'tarif' => 12000, 'dispo' => true],
            ['name' => 'Dr. Paul Essomba', 'specialite' => 'Pédiatrie', 'type' => 'specialiste', 'hopital' => $hopitalDouala, 'region' => 'Littoral', 'tarif' => 10000, 'dispo' => false],
            ['name' => 'Dr. Claire Fotso', 'specialite' => 'Dermatologie', 'type' => 'specialiste', 'hopital' => $hopitalYaounde, 'region' => 'Centre', 'tarif' => 11000, 'dispo' => true],
            ['name' => 'Dr. Thomas Dubois', 'specialite' => 'Médecine générale', 'type' => 'generaliste', 'hopital' => $hopitalYaounde, 'region' => 'Centre', 'tarif' => 5500, 'dispo' => false],
            ['name' => 'Dr. Aminatou Bello', 'specialite' => 'Gynécologie', 'type' => 'specialiste', 'hopital' => $hopitalDouala, 'region' => 'Littoral', 'tarif' => 13000, 'dispo' => true],
        ];

        $medecins = [];
        foreach ($medecinsData as $i => $m) {
            $user = User::create([
                'name' => $m['name'],
                'email' => 'medecin'.($i + 1).'@suivihealth.cm',
                'password' => Hash::make('password'),
                'role' => 'medecin',
                'hopital_id' => $m['hopital']->id,
            ]);

            $medecins[] = Medecin::create([
                'user_id' => $user->id,
                'specialite' => $m['specialite'],
                'type' => $m['type'],
                'region' => $m['region'],
                'hopital' => $m['hopital']->nom,
                'hopital_id' => $m['hopital']->id,
                'numero_ordre' => 'CM-2024-'.str_pad($i + 1, 4, '0', STR_PAD_LEFT),
                'telephone' => '+237 6'.rand(70000000, 99999999),
                'tarif' => $m['tarif'],
                'statut' => 'actif',
                'disponible_immediat' => $m['dispo'],
            ]);
        }

        // ============ PATIENTS ============
        $patientsData = [
            ['name' => 'Kelly Canela', 'email' => 'patient@suivihealth.cm', 'sexe' => 'F', 'sang' => 'O+', 'allergies' => 'Pénicilline'],
            ['name' => 'Junior Mbappe', 'email' => 'patient2@suivihealth.cm', 'sexe' => 'M', 'sang' => 'A+', 'allergies' => null],
            ['name' => 'Aicha Njoya', 'email' => 'patient3@suivihealth.cm', 'sexe' => 'F', 'sang' => 'B+', 'allergies' => 'Arachides'],
        ];

        $patients = [];
        foreach ($patientsData as $i => $p) {
            $user = User::create([
                'name' => $p['name'],
                'email' => $p['email'],
                'password' => Hash::make('password'),
                'role' => 'patient',
            ]);

            $patients[] = Patient::create([
                'user_id' => $user->id,
                'date_naissance' => now()->subYears(rand(20, 55))->subDays(rand(1, 300)),
                'sexe' => $p['sexe'],
                'telephone' => '+237 6'.rand(70000000, 99999999),
                'adresse' => 'Quartier '.['Bonapriso', 'Bastos', 'Akwa', 'Mvog-Ada'][rand(0, 3)],
                'groupe_sanguin' => $p['sang'],
                'allergies' => $p['allergies'],
            ]);
        }

        // ============ SYMPTÔMES ============
        $symptomesData = [
            ['titre' => 'Maux de tête', 'description' => 'Douleur persistante depuis 2 jours, surtout le matin.', 'gravite' => 'moderee'],
            ['titre' => 'Fièvre', 'description' => 'Température à 38.5°C depuis hier soir.', 'gravite' => 'moderee'],
            ['titre' => 'Toux sèche', 'description' => 'Toux légère depuis 3 jours, sans fièvre.', 'gravite' => 'legere'],
            ['titre' => 'Douleur thoracique', 'description' => 'Gêne au niveau de la poitrine lors d\'un effort.', 'gravite' => 'severe'],
        ];
        foreach ($patients as $patient) {
            foreach (array_slice($symptomesData, 0, rand(1, 3)) as $s) {
                Symptome::create(array_merge($s, ['patient_id' => $patient->id]));
            }
        }

        // ============ CONSTANTES ============
        foreach ($patients as $patient) {
            for ($i = 5; $i >= 0; $i--) {
                Constante::create([
                    'patient_id' => $patient->id,
                    'type' => 'poids',
                    'valeur' => rand(600, 900) / 10,
                    'created_at' => now()->subDays($i * 7),
                    'updated_at' => now()->subDays($i * 7),
                ]);
                Constante::create([
                    'patient_id' => $patient->id,
                    'type' => 'tension',
                    'valeur' => rand(110, 135),
                    'valeur_secondaire' => rand(70, 88),
                    'created_at' => now()->subDays($i * 7),
                    'updated_at' => now()->subDays($i * 7),
                ]);
            }
        }

        // ============ VACCINATIONS ============
        foreach ($patients as $patient) {
            Vaccination::create([
                'patient_id' => $patient->id,
                'nom_vaccin' => 'Fièvre jaune',
                'date_administration' => now()->subYears(2),
                'date_rappel' => now()->addYears(8),
            ]);
            Vaccination::create([
                'patient_id' => $patient->id,
                'nom_vaccin' => 'Tétanos',
                'date_administration' => now()->subYears(1),
                'date_rappel' => now()->addYears(9),
            ]);
        }

        // ============ RENDEZ-VOUS (différents statuts pour tester tous les cas) ============
        RendezVous::create([
            'patient_id' => $patients[0]->id, 'medecin_id' => $medecins[0]->id,
            'mode' => 'video', 'type' => 'immediat', 'montant' => 5000,
            'moyen_paiement' => 'orange_money', 'statut_paiement' => 'paye', 'statut' => 'confirme',
        ]);
        RendezVous::create([
            'patient_id' => $patients[0]->id, 'medecin_id' => $medecins[2]->id,
            'mode' => 'chat', 'type' => 'programme', 'date_rdv' => now()->addDays(3), 'heure_rdv' => '14:00',
            'montant' => 12000, 'moyen_paiement' => 'mtn_momo', 'statut_paiement' => 'paye', 'statut' => 'confirme',
        ]);
        RendezVous::create([
            'patient_id' => $patients[1]->id, 'medecin_id' => $medecins[0]->id,
            'mode' => 'audio', 'type' => 'immediat', 'montant' => 5000,
            'moyen_paiement' => 'carte', 'statut_paiement' => 'paye', 'statut' => 'en_attente',
        ]);
        RendezVous::create([
            'patient_id' => $patients[1]->id, 'medecin_id' => $medecins[1]->id,
            'mode' => 'video', 'type' => 'immediat', 'montant' => 5000,
            'moyen_paiement' => 'orange_money', 'statut_paiement' => 'paye', 'statut' => 'termine',
            'updated_at' => now()->subDays(2),
        ]);
        RendezVous::create([
            'patient_id' => $patients[2]->id, 'medecin_id' => $medecins[4]->id,
            'mode' => 'chat', 'type' => 'immediat', 'montant' => 11000,
            'moyen_paiement' => 'mtn_momo', 'statut_paiement' => 'paye', 'statut' => 'a_reprogrammer',
        ]);

        // ============ ORDONNANCES ============
        Ordonnance::create([
            'patient_id' => $patients[0]->id, 'medecin_id' => $medecins[0]->id,
            'medicaments' => "Paracétamol 500mg — 1 comprimé 3x/jour pendant 5 jours\nAmoxicilline 500mg — 1 gélule matin et soir pendant 7 jours",
            'instructions' => "Prendre après les repas. Consulter en cas de persistance des symptômes.",
            'date_prescription' => now()->subDays(4),
        ]);
        Ordonnance::create([
            'patient_id' => $patients[1]->id, 'medecin_id' => $medecins[1]->id,
            'medicaments' => "Ibuprofène 400mg — 1 comprimé 2x/jour pendant 3 jours",
            'instructions' => "Ne pas dépasser 3 jours sans avis médical.",
            'date_prescription' => now()->subDays(2),
        ]);

        // ============ PLAINTES ============
        Plainte::create([
            'patient_id' => $patients[1]->id,
            'rendez_vous_id' => RendezVous::where('patient_id', $patients[1]->id)->first()?->id,
            'sujet' => 'Paiement débité mais consultation non confirmée',
            'message' => 'Bonjour, j\'ai payé pour une consultation immédiate mais le médecin n\'a jamais répondu.',
            'statut' => 'nouvelle',
        ]);

        // ============ NOTIFICATIONS ============
        Notification::create([
            'user_id' => $patients[0]->user_id,
            'titre' => 'Rendez-vous confirmé',
            'message' => 'Votre consultation avec Dr. Jean Belinga est confirmée.',
            'lu' => false,
        ]);
        Notification::create([
            'user_id' => $medecins[0]->user_id,
            'titre' => 'Nouvelle demande de consultation',
            'message' => 'Junior Mbappe souhaite une consultation audio.',
            'lu' => false,
        ]);

        $this->command->info('Données de test créées avec succès !');
        $this->command->table(['Rôle', 'Email', 'Mot de passe'], [
            ['Super Admin', 'superadmin@suivihealth.cm', 'password'],
            ['Admin (Douala)', 'admin@suivihealth.cm', 'password'],
            ['Admin (Yaoundé)', 'admin2@suivihealth.cm', 'password'],
            ['Médecin généraliste (dispo)', 'medecin1@suivihealth.cm', 'password'],
            ['Médecin spécialiste (dispo)', 'medecin3@suivihealth.cm', 'password'],
            ['Médecin (indisponible)', 'medecin4@suivihealth.cm', 'password'],
            ['Patient', 'patient@suivihealth.cm', 'password'],
            ['Patient 2', 'patient2@suivihealth.cm', 'password'],
            ['Patient 3', 'patient3@suivihealth.cm', 'password'],
        ]);
    }
}