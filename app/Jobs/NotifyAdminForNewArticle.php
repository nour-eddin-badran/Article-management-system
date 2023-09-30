<?php

namespace App\Jobs;

use App\Models\Article;
use App\Models\User;
use App\Modules\EnumManager\Enums\RoleTypeEnum;
use App\Notifications\NewArticleNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class NotifyAdminForNewArticle implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private Article $article)
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $dminUsers = User::whereRelation('roles', 'name', RoleTypeEnum::ADMIN)->get();

        foreach ($dminUsers as $user) {
            $user->notify(new NewArticleNotification($this->article));
        }
    }
}
