<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RendezVous extends Model
{
    protected $table = 'rendez_vous';

    protected $fillable = [
        'salle_id', 'patient_id', 'medecin_id', 'mode', 'type', 'date_rdv',
        'heure_rdv', 'montant', 'moyen_paiement', 'statut_paiement', 'statut',
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function medecin()
    {
        return $this->belongsTo(Medecin::class);
    }
    protected static function booted()
    {
        static::creating(function ($rdv) {
            $rdv->salle_id = (string) \Illuminate\Support\Str::uuid();
        });
    }
    
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}