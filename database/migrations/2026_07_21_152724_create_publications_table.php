<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('publications', function (Blueprint $table) {
            $table->id();

            $table->foreignId('auteur_id')
                  ->constrained('users')
                  ->cascadeOnDelete();

            $table->string('titre')->nullable();
            $table->text('contenu');
            $table->string('categorie')->nullable();

            $table->enum('statut', [
                'publie',
                'brouillon'
            ])->default('publie');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('publications');
    }
};
