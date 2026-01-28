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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();

            // Author
            $table->foreignId('profile_id')
                  ->constrained()
                  ->cascadeOnDelete();

            // Parent post (nullable for top-level posts)
            $table->foreignId('parent_id')
                  ->nullable()
                  ->constrained('posts')
                  ->cascadeOnDelete();

            // Post content (required)
            $table->text('content');

            $table->timestamps();

            // Indexes for common queries
            $table->index('parent_id');
            $table->index(['profile_id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
