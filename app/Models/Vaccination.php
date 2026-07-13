<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vaccination extends Model
{
    protected $fillable = ['patient_id', 'nom_vaccin', 'date_administration', 'date_rappel'];

    protected $casts = ['date_administration' => 'date', 'date_rappel' => 'date'];

    public function patient() { return $this->belongsTo(Patient::class); }
}