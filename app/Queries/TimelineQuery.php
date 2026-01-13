<?php

namespace App\Queries;

use App\Models\Follow;
use App\Models\Post;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class TimelineQuery
{
    private $viewer;

    public static function forViewer($viewer = null): self
    {
        return new self($viewer);
    }

    private function __construct($viewer = null)
    {
        $this->viewer = $viewer;
    }

    public function get(): Collection
    {
        return $this->baseQuery()->get()->map(function ($post) {
            return $this->normalize($post);
        });
    }

    public function paginate(int $perPage = 20): LengthAwarePaginator
    {
        return $this->baseQuery()->latest()->paginate($perPage)->through(function ($post) {
            return $this->normalize($post);
        });
    }

    private function baseQuery(): Builder
    {
        $viewerId = $this->viewer ? $this->viewer->id : 0;

        // Timeline requires authentication - if no viewer, return empty
        if (!$this->viewer) {
            return Post::query()->whereRaw('1 = 0');
        }

        // Get fresh following IDs directly from the database to avoid stale relationship cache
        // Query the database directly to ensure we get the latest follows
        // Use DB facade to ensure we're querying the same connection
        $followingIds = DB::table('follows')
            ->where('follower_profile_id', $this->viewer->id)
            ->pluck('following_profile_id')
            ->toArray();

        // Always include the viewer's own posts
        $followingIds[] = $this->viewer->id;
        
        // Remove duplicates and ensure we have values
        $followingIds = array_values(array_unique($followingIds));
        
        // If no following IDs, return empty query
        if (empty($followingIds)) {
            return Post::query()->whereRaw('1 = 0');
        }

        return Post::query()
            ->whereIn('profile_id', $followingIds)
            ->whereNull('parent_id')
            ->with(['profile', 'repostOf.profile'])
            ->withCount(['replies', 'likes', 'reposts'])
            ->select('posts.*')
            ->selectRaw(
                '(exists (select 1 from likes where likes.post_id = posts.id and likes.profile_id = ?)) as has_liked',
                [$viewerId]
            )
            ->selectRaw(
                '(exists (select 1 from posts as reposts where reposts.repost_of_id = posts.id and reposts.profile_id = ?)) as has_reposted',
                [$viewerId]
            )
            ->selectRaw(
                '(exists (select 1 from likes where likes.post_id = posts.repost_of_id and likes.profile_id = ?)) as liked_original',
                [$viewerId]
            )
            ->selectRaw(
                '(exists (select 1 from posts as reposts where reposts.repost_of_id = posts.repost_of_id and reposts.profile_id = ?)) as reposted_original',
                [$viewerId]
            )
            ->latest();
    }

    private function normalize($post)
    {
        // If this post is a pure repost (no content), then copy the "original" flags
        if ($post->repostOf && $post->content === null) {
            $post->repostOf->has_liked = (bool) ($post->liked_original ?? $post->has_liked);
            $post->repostOf->has_reposted = (bool) ($post->reposted_original ?? $post->has_reposted);
        }

        // cast top-level flags
        $post->has_liked = (bool) ($post->has_liked ?? false);
        $post->has_reposted = (bool) ($post->has_reposted ?? false);

        return $post;
    }
}
