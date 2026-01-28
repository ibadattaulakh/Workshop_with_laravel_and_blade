<?php

declare(strict_types=1);

namespace App\Queries;

use App\Models\Post;
use App\Models\Profile;

class PostThreadQuery
{
    private Post $post;
    private $viewer; // may be null

    public static function for(Post $post, $viewer = null): self
    {
        return new self($post, $viewer);
    }

    private function __construct(Post $post, $viewer = null)
    {
        $this->post = $post;
        $this->viewer = $viewer;
    }

    public function load(): Post
    {
        $viewerId = $this->viewer ? $this->viewer->id : 0;

        $this->post->load([
            'profile',
            'replies' => fn ($q) => $q
                ->withCount(['likes', 'replies', 'reposts'])
                ->withExists([
                    'likes as has_liked' => fn ($q) => $q->where('profile_id', $viewerId),
                    'reposts as has_reposted' => fn ($q) => $q->where('profile_id', $viewerId),
                ])
                ->with([
                    'profile',
                    'parent.profile',
                    'replies' => fn ($q) => $q
                        ->withCount(['likes', 'replies', 'reposts'])
                        ->withExists([
                            'likes as has_liked' => fn ($q) => $q->where('profile_id', $viewerId),
                            'reposts as has_reposted' => fn ($q) => $q->where('profile_id', $viewerId),
                        ])
                        ->with(['profile', 'parent.profile'])
                        ->oldest(),
                ])
                ->oldest(),
        ])->loadCount(['likes', 'replies', 'reposts'])
            ->loadExists([
                'likes as has_liked' => fn ($q) => $q->where('profile_id', $viewerId),
                'reposts as has_reposted' => fn ($q) => $q->where('profile_id', $viewerId),
            ]);

        // Cast flags to boolean
        $this->post->has_liked = (bool) ($this->post->has_liked ?? false);
        $this->post->has_reposted = (bool) ($this->post->has_reposted ?? false);

        return $this->post;
    }
}
