<?php

namespace App\View\Components;

use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class ArtistsToFollow extends Component
{
    public $profiles;

    public function __construct()
    {
        if (Auth::check()) {
            $currentProfile = Auth::user()->profile;

            // Profiles the current profile is NOT following, and exclude the current profile itself.
            // followings() relationship: profiles where follower_profile_id = current profile's id
            $query = Profile::whereDoesntHave('followings', function ($q) use ($currentProfile) {
                $q->where('follower_profile_id', $currentProfile->id);
            })->where('id', '!=', $currentProfile->id);
        } else {
            // Random profiles when no user signed in
            $query = Profile::query();
        }

        $this->profiles = $query->inRandomOrder()->take(4)->get();
    }

    public function render()
    {
        return view('components.artists-to-follow', ['profiles' => $this->profiles]);
    }
}

