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
        Schema::table('posts', function (Blueprint $table) {
            $table->foreignId('repost_of_id')->nullable()->constrained('posts')->cascadeOnDelete();
            // optional: prevent duplicate reposts per profile:
            // $table->unique(['profile_id', 'repost_of_id'], 'unique_profile_repost');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropUnique('unique_profile_repost'); // if created
            $table->dropConstrainedForeignId('repost_of_id');
        });
    }
};
