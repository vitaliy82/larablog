<?php

namespace App\Observers;

use App\Entities\Comment;

class CommentObserver
{
    /**
     * Handle the comment "creating" event.
     *
     * @param \App\Entities\Comment $comment
     * @return void
     */
    public function creating(Comment $comment)
    {
        $comment->user_id = auth()->user()->id;
    }
}
