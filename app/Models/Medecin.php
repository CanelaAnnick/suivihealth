<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medecin extends Model
{
    protected $fillable = ['user_id', 'specialite', 'numero_ordre', 'telephone', 'statut'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}