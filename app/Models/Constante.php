<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Constante extends Model
{
    protected $fillable = ['patient_id', 'type', 'valeur', 'valeur_secondaire'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}