<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rendez_vous', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->cascadeOnDelete();
            $table->foreignId('medecin_id')->constrained()->cascadeOnDelete();
            $table->enum('mode', ['chat', 'audio', 'video']);
            $table->enum('type', ['immediat', 'programme']);
            $table->date('date_rdv')->nullable();
            $table->time('heure_rdv')->nullable();
            $table->unsignedInteger('montant');
            $table->enum('moyen_paiement', ['orange_money', 'mtn_momo', 'carte'])->nullable();
            $table->enum('statut_paiement', ['en_attente', 'paye', 'echoue'])->default('en_attente');
            $table->enum('statut', ['en_attente', 'confirme', 'annule'])->default('en_attente');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rendez_vous');
    }
};