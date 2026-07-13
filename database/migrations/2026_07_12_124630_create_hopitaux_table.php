<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hopitaux', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('region');
            $table->string('adresse')->nullable();
            $table->string('telephone')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hopitaux');
    }
};