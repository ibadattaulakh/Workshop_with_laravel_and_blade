<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Models\Like;
use App\Models\Post;
use App\Models\Profile;
use App\Queries\PostThreadQuery;
use App\Queries\TimelineQuery;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PostController extends Controller
{
    public function index()
    {
        if (!auth()->check()) {
            abort(403);
        }
        
        // Get the authenticated user's profile
        // Refresh the user to ensure we have the latest data
        $user = auth()->user();
        $user->refresh();
        
        // Load the profile relationship fresh
        $user->load('profile');
        $viewer = $user->profile;
        
        if (!$viewer) {
            abort(500, 'User profile not found');
        }
        
        $posts = \App\Queries\TimelineQuery::forViewer($viewer)->get();

        return view('posts.index', compact('posts', 'viewer'));
    }

    public function show(Profile $profile, Post $post)
    {
        $viewer = auth()->check() ? auth()->user()->profile : null;
        
        $post = \App\Queries\PostThreadQuery::for($post, $viewer)->load();

        return view('posts.show', compact('post'));
    }

    public function store(CreatePostRequest $request)
    {
        $profile = Auth::user()->profile;

        Post::publish($profile, $request->validated()['content']);

        return redirect()->route('posts.index');
    }

    public function reply(CreatePostRequest $request, Profile $profile, Post $post): RedirectResponse
    {
        $currentProfile = auth()->user()->profile;

        Post::reply($currentProfile, $post, $request->validated()['content']);

        return redirect()->route('posts.index');
    }

    public function repost(Profile $profile, Post $post)
    {
        $current = auth()->user()->profile;

        Post::repost($current, $post);

        return redirect()->route('posts.index');
    }

    public function quote(CreatePostRequest $request, Profile $profile, Post $post)
    {
        $current = auth()->user()->profile;

        Post::repost($current, $post, $request->validated()['content']);

        return redirect()->route('posts.index');
    }

    public function like(Profile $profile, Post $post)
    {
        $current = auth()->user()->profile;

        $like = Like::createLike($current, $post);

        // Return redirect for browser tests, JSON for AJAX requests
        if (request()->expectsJson()) {
            return response()->json(compact('like'));
        }

        return back();
    }

    public function unlike(Profile $profile, Post $post)
    {
        $current = auth()->user()->profile;

        $success = (bool) Like::removeLike($current, $post);

        // Return redirect for browser tests, JSON for AJAX requests
        if (request()->expectsJson()) {
            return response()->json(compact('success'));
        }

        return back();
    }

    public function destroy(Profile $profile, Post $post)
    {
        $current = auth()->user()->profile;
        $success = false;

        // If the current profile is the owner in the URL, they can delete the post directly
        if ($current->id === $profile->id) {
            $success = (bool) $post->delete();
            return response()->json(compact('success'));
        }

        // Otherwise, maybe this is a pure repost of the original post:
        $repost = $post->reposts()->where('profile_id', $current->id)->first();

        if ($repost) {
            $success = (bool) $repost->delete();
        }

        return response()->json(compact('success'));
    }
}
