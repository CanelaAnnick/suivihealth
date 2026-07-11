<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = ['user_id', 'date_naissance', 'sexe', 'telephone', 'adresse', 'groupe_sanguin'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function symptomes()
    {
        return $this->hasMany(Symptome::class);
    }
    public function constantes()
    {
        return $this->hasMany(Constante::class);
    }
    public function ordonnances()
    {
        return $this->hasMany(Ordonnance::class);
    }
    public function rendezVous()
    {
        return $this->hasMany(RendezVous::class);
    }
}