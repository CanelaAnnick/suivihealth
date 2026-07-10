<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Symptome extends Model
{
    protected $fillable = ['patient_id', 'titre', 'description', 'gravite'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}