<?php

namespace Database\Seeders;

use App\Models\Follow;
use App\Models\Like;
use App\Models\Post;
use App\Models\Profile;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create 20 profiles
        $profiles = Profile::factory(20)->create();

        // Create 5 posts for each profile
        $profiles->each(function (Profile $profile) {
            Post::factory(5)->create(['profile_id' => $profile->id]);
        });

        // Cache all posts
        $posts = Post::all();

        // Create random follows for each profile (3..7 follows)
        $profiles->each(function (Profile $profile) use ($profiles) {
            $toFollow = $profiles
                ->where('id', '!=', $profile->id)
                ->shuffle()
                ->take(rand(3, 7));

            foreach ($toFollow as $target) {
                // Use firstOrCreate to avoid duplicates
                Follow::createFollow($profile, $target);
            }
        });

        // Create likes: each profile likes 10..20 posts not by itself
        $profiles->each(function (Profile $profile) use ($posts) {
            $candidates = $posts->where('profile_id', '!=', $profile->id)->shuffle()->take(rand(10, 20));

            foreach ($candidates as $post) {
                Like::createLike($profile, $post);
            }
        });

        // Create reposts: each profile reposts 2..5 posts not by itself
        $profiles->each(function (Profile $profile) use ($posts) {
            $candidates = $posts->where('profile_id', '!=', $profile->id)->shuffle()->take(rand(2, 5));

            foreach ($candidates as $post) {
                Post::repost($profile, $post, rand(0, 1) ? null : 'Great post!');
            }
        });

        // Create 20..30 replies
        $replyCount = rand(20, 30);
        $created = 0;

        while ($created < $replyCount) {
            $parent = $posts->random();

            // pick a reply author who is NOT the parent post's author
            $replyAuthor = $profiles->where('id', '!=', $parent->profile_id)->random();

            // create reply post with parent_id
            Post::factory()->create([
                'profile_id' => $replyAuthor->id,
                'parent_id'  => $parent->id,
            ]);

            $created++;
        }
    }
}
