<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $handle = $this->faker->unique()->userName();

        return [
            'user_id'      => User::factory(),
            'display_name' => $this->faker->name(),
            'handle'       => $handle,
            'bio'          => $this->faker->sentences(3, true),
            // Avatar: 80x80 with gray background and black text
            'avatar_url'   => "https://dummyimage.com/80x80/cccccc/000000&text={$handle}",
            // Cover: 1400x640, darker bg, orange text (example hex), display handle as text
            'cover_url'    => "https://dummyimage.com/1400x640/555555/ff8800&text={$handle}",
        ];
    }
}
