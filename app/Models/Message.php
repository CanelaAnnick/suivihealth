<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['rendez_vous_id', 'sender_id', 'contenu'];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}