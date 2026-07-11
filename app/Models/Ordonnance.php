<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ordonnance extends Model
{
    protected $fillable = ['patient_id', 'medecin_id', 'medicaments', 'instructions', 'date_prescription'];

    protected $casts = ['date_prescription' => 'date'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function medecin()
    {
        return $this->belongsTo(Medecin::class);
    }
}