<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('symptomes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->cascadeOnDelete();
            $table->string('titre');
            $table->text('description');
            $table->enum('gravite', ['legere', 'moderee', 'severe'])->default('legere');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('symptomes');
    }
};