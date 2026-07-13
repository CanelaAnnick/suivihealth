<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hopital extends Model
{
    protected $table = 'hopitaux';
    protected $fillable = ['nom', 'region', 'adresse', 'telephone'];

    public function medecins() { return $this->hasMany(Medecin::class); }
    public function admins() { return $this->hasMany(User::class)->where('role', 'admin'); }
}