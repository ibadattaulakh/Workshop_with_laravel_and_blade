<?php

namespace App\View\Components;

use App\Models\Post;
use Illuminate\View\Component;

class LikeButton extends Component
{
    public Post $post;
    public bool $hasLiked;
    public int $count;

    public function __construct(Post $post)
    {
        $this->post = $post;
        $this->hasLiked = (bool) ($post->has_liked ?? false);
        $this->count = $post->likes_count ?? 0;
    }

    public function render()
    {
        return view('components.like-button');
    }
}

