<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ordonnances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->cascadeOnDelete();
            $table->foreignId('medecin_id')->constrained()->cascadeOnDelete();
            $table->text('medicaments');
            $table->text('instructions')->nullable();
            $table->date('date_prescription');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ordonnances');
    }
};