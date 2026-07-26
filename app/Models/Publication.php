<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use HasFactory;

    protected $table = 'publications';

    protected $fillable = [
        'auteur_id',
        'titre',
        'contenu',
        'categorie',
        'statut',
        'media_path',
        'media_type',
    ];

    public function auteur()
    {
        return $this->belongsTo(User::class, 'auteur_id');
    }

    public function commentaires()
    {
        return $this->hasMany(Commentaire::class, 'publication_id')->latest();
    }

    public function scopePubliees($query)
    {
        return $query->where('statut', 'publie');
    }
}
