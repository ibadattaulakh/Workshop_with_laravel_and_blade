<?php

namespace App\View\Components;

use App\Models\Post;
use Illuminate\View\Component;

class RepostButton extends Component
{
    public Post $post;
    public bool $hasReposted;
    public int $count;

    public function __construct(Post $post)
    {
        $this->post = $post;
        $this->hasReposted = (bool) ($post->has_reposted ?? false);
        $this->count = $post->reposts_count ?? 0;
    }

    public function render()
    {
        return view('components.repost-button');
    }
}

