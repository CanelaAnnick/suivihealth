<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id
 * @property int $patient_id
 * @property string $type
 * @property numeric $valeur
 * @property numeric|null $valeur_secondaire
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Patient|null $patient
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Constante newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Constante newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Constante query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Constante whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Constante whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Constante wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Constante whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Constante whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Constante whereValeur($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Constante whereValeurSecondaire($value)
 */
	class Constante extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $nom
 * @property string $region
 * @property string|null $adresse
 * @property string|null $telephone
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\User> $admins
 * @property-read int|null $admins_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Medecin> $medecins
 * @property-read int|null $medecins_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hopital newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hopital newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hopital query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hopital whereAdresse($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hopital whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hopital whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hopital whereNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hopital whereRegion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hopital whereTelephone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Hopital whereUpdatedAt($value)
 */
	class Hopital extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $user_id
 * @property string $specialite
 * @property string $type
 * @property string|null $region
 * @property string|null $hopital
 * @property int|null $hopital_id
 * @property string|null $photo
 * @property int $tarif
 * @property string $numero_ordre
 * @property string|null $telephone
 * @property string $statut
 * @property bool $disponible_immediat
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Models\Hopital|null $hopitalRelation
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Medecin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Medecin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Medecin onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Medecin query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Medecin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Medecin whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Medecin whereDisponibleImmediat($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Medecin whereHopital($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Medecin whereHopitalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Medecin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Medecin whereNumeroOrdre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Medecin wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Medecin whereRegion($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Medecin whereSpecialite($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Medecin whereStatut($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Medecin whereTarif($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Medecin whereTelephone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Medecin whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Medecin whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Medecin whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Medecin withTrashed(bool $withTrashed = true)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Medecin withoutTrashed()
 */
	class Medecin extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $rendez_vous_id
 * @property int $sender_id
 * @property string $contenu
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $sender
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Message newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Message newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Message query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Message whereContenu($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Message whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Message whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Message whereRendezVousId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Message whereSenderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Message whereUpdatedAt($value)
 */
	class Message extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $user_id
 * @property string $titre
 * @property string $message
 * @property int $lu
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification whereLu($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification whereTitre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Notification whereUserId($value)
 */
	class Notification extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $patient_id
 * @property int $medecin_id
 * @property string $medicaments
 * @property string|null $instructions
 * @property \Illuminate\Support\Carbon $date_prescription
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Medecin|null $medecin
 * @property-read \App\Models\Patient|null $patient
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ordonnance newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ordonnance newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ordonnance query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ordonnance whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ordonnance whereDatePrescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ordonnance whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ordonnance whereInstructions($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ordonnance whereMedecinId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ordonnance whereMedicaments($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ordonnance wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Ordonnance whereUpdatedAt($value)
 */
	class Ordonnance extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $user_id
 * @property string|null $date_naissance
 * @property string|null $sexe
 * @property string|null $telephone
 * @property string|null $adresse
 * @property string|null $groupe_sanguin
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $allergies
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Constante> $constantes
 * @property-read int|null $constantes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Ordonnance> $ordonnances
 * @property-read int|null $ordonnances_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Plainte> $plaintes
 * @property-read int|null $plaintes_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\RendezVous> $rendezVous
 * @property-read int|null $rendez_vous_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Symptome> $symptomes
 * @property-read int|null $symptomes_count
 * @property-read \App\Models\User|null $user
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Vaccination> $vaccinations
 * @property-read int|null $vaccinations_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Patient newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Patient newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Patient query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Patient whereAdresse($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Patient whereAllergies($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Patient whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Patient whereDateNaissance($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Patient whereGroupeSanguin($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Patient whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Patient whereSexe($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Patient whereTelephone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Patient whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Patient whereUserId($value)
 */
	class Patient extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $patient_id
 * @property int|null $rendez_vous_id
 * @property string $sujet
 * @property string $message
 * @property string $statut
 * @property string|null $reponse_admin
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Patient|null $patient
 * @property-read \App\Models\RendezVous|null $rendezVous
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plainte newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plainte newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plainte query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plainte whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plainte whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plainte whereMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plainte wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plainte whereRendezVousId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plainte whereReponseAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plainte whereStatut($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plainte whereSujet($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Plainte whereUpdatedAt($value)
 */
	class Plainte extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string|null $salle_id
 * @property int $patient_id
 * @property int $medecin_id
 * @property string $mode
 * @property string $type
 * @property string|null $date_rdv
 * @property string|null $heure_rdv
 * @property int $montant
 * @property string|null $moyen_paiement
 * @property string $statut_paiement
 * @property string|null $statut
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Medecin|null $medecin
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Message> $messages
 * @property-read int|null $messages_count
 * @property-read \App\Models\Patient|null $patient
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous whereDateRdv($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous whereHeureRdv($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous whereMedecinId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous whereMode($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous whereMontant($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous whereMoyenPaiement($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous whereSalleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous whereStatut($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous whereStatutPaiement($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|RendezVous whereUpdatedAt($value)
 */
	class RendezVous extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $patient_id
 * @property string $titre
 * @property string $description
 * @property string $gravite
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Patient|null $patient
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Symptome newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Symptome newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Symptome query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Symptome whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Symptome whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Symptome whereGravite($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Symptome whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Symptome wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Symptome whereTitre($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Symptome whereUpdatedAt($value)
 */
	class Symptome extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $role
 * @property bool $actif
 * @property int|null $hopital_id
 * @property string|null $photo
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Notification> $appNotifications
 * @property-read int|null $app_notifications_count
 * @property-read \App\Models\Hopital|null $hopital
 * @property-read \App\Models\Medecin|null $medecin
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\Patient|null $patient
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereActif($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereHopitalId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePhoto($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $patient_id
 * @property string $nom_vaccin
 * @property \Illuminate\Support\Carbon $date_administration
 * @property \Illuminate\Support\Carbon|null $date_rappel
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Patient|null $patient
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vaccination newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vaccination newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vaccination query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vaccination whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vaccination whereDateAdministration($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vaccination whereDateRappel($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vaccination whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vaccination whereNomVaccin($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vaccination wherePatientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Vaccination whereUpdatedAt($value)
 */
	class Vaccination extends \Eloquent {}
}

