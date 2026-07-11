<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medecin extends Model
{
    protected $fillable = ['user_id', 'specialite', 'type', 'region', 'hopital', 'photo', 'tarif', 'numero_ordre', 'telephone', 'statut', 'disponible_immediat'];

    protected $casts = ['disponible_immediat' => 'boolean'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}