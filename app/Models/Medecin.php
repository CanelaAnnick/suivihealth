<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Medecin extends Model
{
    use SoftDeletes;

    protected $fillable = ['user_id', 'specialite', 'type', 'region', 'hopital', 'photo', 'tarif', 'numero_ordre', 'telephone', 'statut', 'disponible_immediat'];

    protected $casts = ['disponible_immediat' => 'boolean'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function hopitalRelation()
    {
        return $this->belongsTo(Hopital::class, 'hopital_id');
    }
}