<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plainte extends Model
{
    protected $fillable = ['patient_id', 'rendez_vous_id', 'sujet', 'message', 'statut', 'reponse_admin'];

    public function patient() { return $this->belongsTo(Patient::class); }
    public function rendezVous() { return $this->belongsTo(RendezVous::class); }
}