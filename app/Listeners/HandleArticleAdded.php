<?php

namespace App\Listeners;

use App\Events\ArticleAddedEvent;
use App\Jobs\NotifyAdminForNewArticle;
use App\Modules\EnumManager\Enums\RoleTypeEnum;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class HandleArticleAdded
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
     * @param  ArticleAddedEvent  $event
     * @return void
     */
    public function handle(ArticleAddedEvent $event)
    {
        if ($event->article->author->hasRole(RoleTypeEnum::AUTHOR)) {
            NotifyAdminForNewArticle::dispatch($event->article);
        }
    }
}
