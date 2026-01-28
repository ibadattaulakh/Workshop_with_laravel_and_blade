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
        Schema::create('likes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('profile_id')->constrained()->cascadeOnDelete();
            $table->foreignId('post_id')->constrained()->cascadeOnDelete();

            $table->timestamps();

            // prevent duplicate likes from the same profile on the same post
            $table->unique(['profile_id', 'post_id'], 'unique_profile_post_like');

            // useful index for fetching likes/counts for a post (e.g. timeline)
            $table->index(['post_id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('likes');
    }
};
