<?php

use App\Models\Follow;
use App\Models\Profile;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('prevents a profile from following itself', function () {
    $profile = Profile::factory()->create();

    expect(fn () => Follow::createFollow($profile, $profile))
        ->toThrow(\InvalidArgumentException::class, 'A profile cannot follow itself.');
});

it('allows a profile to follow another profile', function () {
    $profileOne = Profile::factory()->create();
    $profileTwo = Profile::factory()->create();

    $follow = Follow::createFollow($profileOne, $profileTwo);

    expect($profileOne->followings->contains($profileTwo))->toBeTrue();
    expect($profileTwo->followers->contains($profileOne))->toBeTrue();
    expect($follow->follower_profile_id)->toBe($profileOne->id);
    expect($follow->following_profile_id)->toBe($profileTwo->id);
});

it('allows a profile to unfollow another profile', function () {
    $profileOne = Profile::factory()->create();
    $profileTwo = Profile::factory()->create();

    $follow = Follow::createFollow($profileOne, $profileTwo);

    $success = Follow::removeFollow($profileOne, $profileTwo);

    // refresh relationships / model state
    $profileOne->refresh();
    $profileTwo->refresh();
    $follow = $follow->fresh();

    expect($profileOne->followings->contains($profileTwo))->toBeFalse();
    expect($profileTwo->followers->contains($profileOne))->toBeFalse();
    expect($success)->toBeTrue();
    expect($follow)->toBeNull();
});
