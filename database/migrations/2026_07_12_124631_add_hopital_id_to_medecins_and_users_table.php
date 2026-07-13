<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('medecins', function (Blueprint $table) {
            $table->foreignId('hopital_id')->nullable()->after('hopital')->constrained()->nullOnDelete();
        });
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('hopital_id')->nullable()->after('role')->constrained()->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('medecins', function (Blueprint $table) {
            $table->dropConstrainedForeignId('hopital_id');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->dropConstrainedForeignId('hopital_id');
        });
    }
};