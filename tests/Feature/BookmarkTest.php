<?php

use App\Models\Post;
use App\Models\User;

it('allows a user to bookmark a post', function () {
    $user = User::factory()->create();
    $post = Post::factory()->create();

    $user->bookmark($post);

    expect($user->bookmarks()->count())->toBe(1);

    $this->assertDatabaseHas('bookmarks', [
        'user_id' => $user->id,
        'post_id' => $post->id,
    ]);
});
