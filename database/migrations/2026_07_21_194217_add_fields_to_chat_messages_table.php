<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('chat_messages', function (Blueprint $table) {

            $table->foreignId('user_id')
                  ->after('id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->enum('role', ['user', 'assistant'])
                  ->after('user_id');

            $table->longText('contenu')
                  ->after('role');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chat_messages', function (Blueprint $table) {

            $table->dropForeign(['user_id']);
            $table->dropColumn(['user_id', 'role', 'contenu']);

        });
    }
};
