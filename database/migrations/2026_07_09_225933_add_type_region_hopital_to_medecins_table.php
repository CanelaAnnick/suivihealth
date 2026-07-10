<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('medecins', function (Blueprint $table) {
            $table->enum('type', ['generaliste', 'specialiste'])->default('generaliste')->after('specialite');
            $table->string('region')->nullable()->after('type');
            $table->string('hopital')->nullable()->after('region');
        });
    }

    public function down(): void
    {
        Schema::table('medecins', function (Blueprint $table) {
            $table->dropColumn(['type', 'region', 'hopital']);
        });
    }
};