<?php

namespace App\View\Components;

use App\Models\Profile;
use Illuminate\View\Component;

class FollowButton extends Component
{
    public Profile $profile;
    public bool $isFollowing;

    public function __construct(Profile $profile)
    {
        $this->profile = $profile;
        // Check if current user is following this profile
        if (auth()->check()) {
            $currentProfile = auth()->user()->profile;
            $this->isFollowing = $currentProfile->followings()->where('following_profile_id', $profile->id)->exists();
        } else {
            $this->isFollowing = false;
        }
    }

    public function render()
    {
        return view('components.follow-button');
    }
}

