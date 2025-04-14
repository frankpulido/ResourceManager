<?php
declare(strict_types=1);

namespace App\Observers;

use App\Models\Comment;
use Illuminate\Contracts\Events\ShouldHandleEventsAfterCommit;

class CommentObserver implements ShouldHandleEventsAfterCommit
{
    /**
     * Handle the Comment "created" event.
     */
    public function created(Comment $comment): void
    {
        $comment->resource()->increment('comment_count');
    }

    /**
     * Handle the Comment "deleted" event.
     */
    public function deleted(Comment $comment): void
    {
        $comment->resource()->decrement('comment_count');
    }

    /**
     * Handle the Comment "restored" event.
     */
    public function restored(Comment $comment): void
    {
        $comment->resource()->increment('comment_count');
    }

    /**
     * Handle the Comment "force deleted" event.
     */
    public function forceDeleted(Comment $comment): void
    {
        $comment->resource()->decrement('comment_count');
    }
}
