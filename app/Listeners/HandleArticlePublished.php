<?php

namespace App\Listeners;

use App\Events\ArticlePublishedEvent;
use App\Jobs\NotifyAdminForNewArticle;
use App\Notifications\ArticlePublishedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class HandleArticlePublished
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ArticlePublishedEvent  $event
     * @return void
     */
    public function handle(ArticlePublishedEvent $event)
    {
        $event->article->author->notify(new ArticlePublishedNotification($event->article));
    }
}
