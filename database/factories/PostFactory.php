<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition()
    {
        return [
            'profile_id' => Profile::factory(),
            'parent_id'  => null,
            'repost_of_id' => null, // default
            'content'    => $this->faker->realText(200),
        ];
    }

    // Create a reply for a given parent post
    public function reply(Post $parent)
    {
        return $this->state(function () use ($parent) {
            return [
                'parent_id' => $parent->id,
                'content'   => $this->faker->text(200),
            ];
        });
    }

    // state for pure repost (no extra content)
    public function repost(Post $original)
    {
        return $this->state(fn () => [
            'repost_of_id' => $original->id,
            'content' => null,
        ]);
    }

    // state for quote-repost
    public function quoteRepost(Post $original)
    {
        return $this->state(fn () => [
            'repost_of_id' => $original->id,
            'content' => $this->faker->realText(100),
        ]);
    }
}
