<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE rendez_vous MODIFY statut ENUM('en_attente','confirme','annule','termine') DEFAULT 'en_attente'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE rendez_vous MODIFY statut ENUM('en_attente','confirme','annule') DEFAULT 'en_attente'");
    }
};