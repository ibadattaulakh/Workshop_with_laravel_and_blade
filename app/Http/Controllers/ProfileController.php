<?php

namespace App\Http\Controllers;

use App\Models\Follow;
use App\Models\Post;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show(Profile $profile)
    {
        // Profile follower/following counts
        $profile->loadCount(['followings', 'followers']);

        $viewer = auth()->check() ? auth()->user()->profile : null;
        
        $posts = \App\Queries\ProfilePageQuery::for($profile, $viewer)->get();

        return view('profiles.show', compact('profile', 'posts'));
    }

    public function replies(Profile $profile)
    {
        // Profile follower/following counts
        $profile->loadCount(['followings', 'followers']);

        $viewer = auth()->check() ? auth()->user()->profile : null;
        
        $posts = \App\Queries\ProfileWithRepliesQuery::for($profile, $viewer)->get();

        return view('profiles.replies', compact('profile', 'posts'));
    }

    public function follow(Profile $profile)
    {
        $current = auth()->user()->profile;

        $follow = Follow::createFollow($current, $profile);

        // Return redirect with message for browser tests, JSON for AJAX requests
        if (request()->expectsJson()) {
            return response()->json(compact('follow'));
        }

        return back()->with('success', 'You are now following '.$profile->handle);
    }

    public function unfollow(Profile $profile)
    {
        $current = auth()->user()->profile;

        $success = (bool) Follow::removeFollow($current, $profile);

        // Return redirect with message for browser tests, JSON for AJAX requests
        if (request()->expectsJson()) {
            return response()->json(compact('success'));
        }

        return back()->with('success', 'You have now unfollowed '.$profile->handle);
    }
}
