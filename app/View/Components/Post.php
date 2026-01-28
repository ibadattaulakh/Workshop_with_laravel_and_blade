<?php

namespace App\View\Components;

use App\Models\Post as PostModel;
use Illuminate\View\Component;

class Post extends Component
{
    public PostModel $original;
    public PostModel $post;
    public bool $showEngagement = true;
    public bool $showReplies = false;

    public function __construct(PostModel $item, $showEngagement = true, $showReplies = false)
    {
        $this->original = $item;
        $this->showEngagement = $showEngagement;
        $this->showReplies = $showReplies;

        // If it's a pure repost (content is null), display the reposted/original post.
        $this->post = ($item->repostOf && $item->content === null)
            ? $item->repostOf
            : $item;
    }

    public function render()
    {
        return view('components.post');
    }
}
